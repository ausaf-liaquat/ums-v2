<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facilities\BannedFacilityClinician;
use App\Models\Facilities\Facility;
use App\Models\Shifts\Shift;
use App\Models\Shifts\ShiftSummary;
use App\Models\Traits\ApiResponser;
use App\Models\UserShift;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ShiftController extends Controller
{
    use ApiResponser;

    public function shifts()
    {
        $facility_ids         = BannedFacilityClinician::where('user_id', auth()->user()->id)->pluck('facility_id')->toArray();
        $bannedFaciltyUserIds = Facility::whereIn('id', $facility_ids)->pluck('user_id')->toArray();
        $usedShifts_ids       = UserShift::where('user_id', auth()->user()->id)->pluck('shift_id')->toArray();
        $shifts               = Shift::where(function ($q) use ($usedShifts_ids, $bannedFaciltyUserIds) {
            $q->where('date', '>=', appToday())->whereNotIn('id', $usedShifts_ids)->whereNotIn('user_id', $bannedFaciltyUserIds);
        })
            ->whereDoesntHave('shift_clinicians', function ($query) {
                $query->where('status', 1); // Exclude if already accepted
            })
            ->get();

        return $this->success(['shifts' => $shifts], 'Shifts', 200);
    }
    public function acceptedShifts()
    {
        $usedShifts_ids = UserShift::where('user_id', auth()->user()->id)->where('status', 1)->pluck('shift_id')->toArray();
        $shifts         = Shift::whereIn('id', $usedShifts_ids)->with('shift_clinicians')->get();
        // $shifts         = Shift::where('date', '>=', appToday())->whereIn('id', $usedShifts_ids)->with('shift_clinicians')->get();

        return $this->success(['shifts' => $shifts], 'Clinicians Shifts', 200);
    }
    public function completedShifts()
    {
        $usedShifts_ids = UserShift::where('user_id', auth()->user()->id)->where('status', 1)->pluck('shift_id')->toArray();
        $shifts         = Shift::where('date', '>=', appToday())->whereIn('id', $usedShifts_ids)->with('shift_clinicians')->get();

        return $this->success(['shifts' => $shifts], 'Clinicians Shifts', 200);
    }
    public function shiftDetail($id)
    {
        $shift           = Shift::find($id);
        $clockInClockOut = UserShift::where('shift_id', $shift->id)->where('user_id', auth()->user()->id)->first();

        return $this->success(['shift' => $shift, 'user_shift' => $clockInClockOut], 'Shift Details', 200);
    }

    public function shiftAccept($id)
    {
        $shift = Shift::findOrFail($id);

        // ✅ Check if shift is already accepted by another clinician
        $alreadyAccepted = UserShift::where('shift_id', $shift->id)
            ->where('status', 1)
            ->exists();

        if ($alreadyAccepted) {
            return $this->error('Shift already accepted by another clinician', 400);
        }

        // ✅ Proceed with assigning to current user
        $shiftUser = UserShift::firstOrNew([
            'user_id'  => auth()->id(),
            'shift_id' => $shift->id,
        ]);

        if ($shiftUser->exists && $shiftUser->status == 1) {
            return $this->error('You have already accepted this shift', 400);
        }

        $shiftUser->status      = 1; // Accepted
        $shiftUser->accepted_at = appNow();
        $shiftUser->save();

        return $this->success('Shift Accepted', 200);
    }

    public function shiftDecline($id)
    {
        $shift = Shift::findOrFail($id);

        $shiftUser = UserShift::firstOrNew([
            'user_id'  => auth()->id(),
            'shift_id' => $shift->id,
        ]);

        if ($shiftUser->exists && $shiftUser->status == 2) {
            return $this->error('Shift already declined', 400);
        }

        $shiftUser->status      = 2; // Rejected
        $shiftUser->rejected_at = appNow();
        $shiftUser->save();

        return $this->success('Shift Declined', 200);
    }

    public function shiftCancel($id)
    {
        $shiftUser = UserShift::where([
            'user_id'  => auth()->id(), // current clinician
            'shift_id' => $id,
        ])->first();

        if (! $shiftUser) {
            return $this->error('Shift not found or not assigned to you.', 404);
        }

        if ($shiftUser->status == 3) {
            return $this->error('Shift already cancelled.', 400);
        }

        $shift = $shiftUser->shift;
        if (! $shift || ! $shift->user) {
            return $this->error('Shift or facility not found.', 404);
        }

        DB::beginTransaction();

        try {
            $refundAmount = $shift->total_amount ?? 0;

            if ($refundAmount > 0) {
                $shift->user->depositFloat($refundAmount, [
                    'type'        => 'shift_refund',
                    'shift_id'    => $shift->id,
                    'description' => 'Shift cancelled by clinician after acceptance in UMS app',
                ]);
            }

            $shiftUser->status       = 3; // 3 = Cancelled
            $shiftUser->cancelled_at = appNow();
            $shiftUser->save();

            DB::commit();

            return $this->success(
                'Shift cancelled successfully.',
                200
            );

        } catch (Throwable $e) {
            DB::rollBack();

            return $this->error('Cancellation failed: ' . $e->getMessage(), 500);
        }
    }

    public function shiftClockin(Request $request, $id)
    {
        $shift = Shift::findOrFail($id);

        // Validate request
        $validator = Validator::make($request->all(), [
            'lat'           => ['required', 'numeric'],
            'lon'           => ['required', 'numeric'],
            'location_name' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Check if user already has an active shift (clocked in but not out)
        $alreadyClockedIn = UserShift::where('user_id', auth()->id())
            ->whereNotNull('clockin')
            ->whereNull('clockout')
            ->first();

        if ($alreadyClockedIn) {
            return $this->error('You are already clocked in to another shift. Please clock out first.', 400);
        }

        // Compare shift date with today
        $today = appNow()->toDateString();

        if ($shift->date < $today) {
            return $this->error('This shift has expired (' . $shift->date . ')', 400);
        }

        if ($shift->date > $today) {
            return $this->error('You can only clock in on the shift date (' . $shift->date . ')', 400);
        }

        // Find user’s shift assignment
        $shiftUser = UserShift::where('shift_id', $shift->id)
            ->where('user_id', auth()->id())
            ->first();

        if (! $shiftUser) {
            return $this->error('Shift Not Exist', 404);
        }

        if ($shiftUser->clockin) {
            return $this->error('Already Clocked In', 400);
        }

        // Update record
        $shiftUser->update([
            'clockin'       => appNow(),
            'clock_in_lat'  => $request->lat,
            'clock_in_lon'  => $request->lon,
            'location_name' => $request->location_name,
            'shift_status'  => 0, // In process
        ]);

        return $this->success('Shift Clocked In', 200);
    }

    public function shiftClockout(Request $request, $id)
    {
        $shift = Shift::findOrFail($id);

        // ✅ Validate request
        $validator = Validator::make($request->all(), [
            'lat' => ['required', 'numeric'],
            'lon' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors(),
            ], 422);
        }

        // ✅ Find user’s shift assignment
        $shiftUser = UserShift::where('shift_id', $shift->id)
            ->where('user_id', auth()->id())
            ->first();

        if (! $shiftUser) {
            return $this->error('Shift Not Exist', 404);
        }

        if (! $shiftUser->clockin) {
            return $this->error('Cannot clock out before clocking in', 400);
        }

        if ($shiftUser->clockout) {
            return $this->error('Already Clocked Out', 400);
        }

        try {
            DB::beginTransaction();

            // ✅ Update shift user record
            $shiftUser->update([
                'clockout'      => appNow(),
                'clock_out_lat' => $request->lat,
                'clock_out_lon' => $request->lon,
                'shift_status'  => 1, // Completed
            ]);

            // ✅ Calculate summary
            $summary = calculateSummary($shift, $shiftUser);

            // ✅ Store summary record
            $shiftSummary = ShiftSummary::create([
                'shift_id'                => $shift->id,
                'total_worked_hours'      => $summary['worked_hours'],
                'clinician_pay'           => $summary['clinician_pay'],
                'holding_refunded_amount' => $summary['holding_refunded'],
            ]);

            // ✅ Refund holding amount if applicable
            if ($shift->user && $summary['holding_refunded'] > 0) {
                $shift->user->depositFloat($summary['holding_refunded'], [
                    'type'       => 'holding_refund',
                    'shift_id'   => $shift->id,
                    'summary_id' => $shiftSummary->id,
                ]);
            }

            DB::commit();

            return $this->success('Shift Clocked Out', 200);
        } catch (Throwable $e) {
            DB::rollBack();

            return $this->error('Something went wrong during clockout. Please try again. ' . $e->getMessage(), 500);
        }
    }

    public function shiftsFilter(Request $request)
    {
        // Fetch banned facility user IDs and used shift IDs only if they are relevant for filtering
        $facility_ids          = BannedFacilityClinician::where('user_id', auth()->id())->pluck('facility_id');
        $bannedFacilityUserIds = Facility::whereIn('id', $facility_ids)->pluck('user_id');
        $usedShiftIds          = UserShift::where('user_id', auth()->id())->pluck('shift_id');

        // Build the shifts query with conditional filtering
        $shifts = Shift::whereNotIn('id', $usedShiftIds)
            ->whereNotIn('user_id', $bannedFacilityUserIds)
            ->where('date', '>=', appToday())
            ->when($request->filled('date'), function ($query) use ($request) {
                $query->where('date', date('Y-m-d', strtotime($request->date)));
            })
            ->when($request->filled('shift_hour'), function ($query) use ($request) {
                $query->where('shift_hour', $request->shift_hour);
            })
            ->when($request->filled('type'), function ($query) use ($request) {
                $query->where('clinician_type', $request->type);
            })
            ->when($request->filled('location'), function ($query) use ($request) {
                $query->where('shift_location', 'like', '%' . $request->location . '%');
            })
            ->whereDoesntHave('shift_clinicians', function ($query) {
                $query->where('status', 1); // Exclude if already accepted
            })
            ->get();

        return $this->success($shifts, 'Shifts', 200);
    }
    public function getShiftHours(): JsonResponse
    {
        $shiftHours = [
            ['value' => '7a-3p(8hrs)', 'label' => '7a-3p(8hrs)'],
            ['value' => '6:45a-3:15p(8.5hrs)', 'label' => '6:45a-3:15p(8.5hrs)'],
            ['value' => '3p-11p(8hrs)', 'label' => '3p-11p(8hrs)'],
            ['value' => '2:45p-11:15p(8.5hrs)', 'label' => '2:45p-11:15p(8.5hrs)'],
            ['value' => '11p-7a(8.5hrs)', 'label' => '11p-7a(8.5hrs)'],
            ['value' => '10:45-7:15a(8.5hrs)', 'label' => '10:45-7:15a(8.5hrs)'],
            ['value' => '7a-7p(12hrs)', 'label' => '7a-7p(12hrs)'],
            ['value' => '7p-7a(12hrs)', 'label' => '7p-7a(12hrs)'],
            ['value' => '6:45a-7:15p(12.5hrs)', 'label' => '6:45a-7:15p(12.5hrs)'],
            ['value' => '6:45p-7:15a(12.5hrs)', 'label' => '6:45p-7:15a(12.5hrs)'],
        ];

        return response()->json($shiftHours);
    }
}
