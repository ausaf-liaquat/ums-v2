<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facilities\BannedFacilityClinician;
use App\Models\Facilities\Facility;
use App\Models\Shifts\Shift;
use App\Models\Traits\ApiResponser;
use App\Models\UserShift;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    use ApiResponser;

    public function shifts()
    {
        $facility_ids = BannedFacilityClinician::where('user_id', auth()->user()->id)->pluck('facility_id')->toArray();
        $bannedFaciltyUserIds = Facility::whereIn('id', $facility_ids)->pluck('user_id')->toArray();
        $usedShifts_ids = UserShift::where('user_id', auth()->user()->id)->pluck('shift_id')->toArray();
        $shifts = Shift::where(function ($q) use ($usedShifts_ids, $bannedFaciltyUserIds) {
            $q->where('date', '>=', now()->format('Y-m-d'))->whereNotIn('id', $usedShifts_ids)->whereNotIn('user_id', $bannedFaciltyUserIds);
        })->get();

        return $this->success(['shifts' => $shifts], 'Shifts', 200);
    }
    public function acceptedShifts()
    {
        $usedShifts_ids = UserShift::where('user_id', auth()->user()->id)->where('status', 1)->pluck('shift_id')->toArray();
        $shifts = Shift::where('date', '>=', now()->format('Y-m-d'))->whereIn('id', $usedShifts_ids)->with('shift_clinicians')->get();

        return $this->success(['shifts' => $shifts], 'Clinicians Shifts', 200);
    }
    public function shiftDetail($id)
    {
        $shift = Shift::find($id);
        $clockInClockOut = UserShift::where('shift_id', $shift->id)->where('user_id', auth()->user()->id)->first();

        return $this->success(['shift' => $shift, 'user_shift' => $clockInClockOut], 'Shift Details', 200);
    }
    public function shiftAccept($id)
    {
        $shift = Shift::findOrFail($id);

        UserShift::create([
            'user_id' => auth()->user()->id,
            'shift_id' => $shift->id,
            'status' => 1,
            'accepted_at' => now(),
            'clockin' => now(),
        ]);

        return $this->success('Shift Accepted', 200);
    }
    public function shiftDecline($id)
    {
        $shift = Shift::findOrFail($id);

        UserShift::create([
            'user_id' => auth()->user()->id,
            'shift_id' => $shift->id,
            'rejected_at' => now(),
            'status' => 2,
        ]);

        return $this->success('Shift Declined', 200);
    }
    public function shiftCancel($id)
    {
        $shift = Shift::findOrFail($id);
        $shift_user = UserShift::where(['user_id' => auth()->user()->id, 'shift_id' => $shift->id])->first();
        if (!$shift_user) {
            return $this->error('Shift Not Exist', 404);
        }
        UserShift::where([
            'user_id' => auth()->user()->id,
            'shift_id' => $shift->id,
        ])->update([
            'status' => 3,
        ]);

        return $this->success('Shift Canceled', 200);
    }
    public function shiftClockout($id)
    {
        $shift = Shift::findOrFail($id);

        $shift_user = UserShift::where('shift_id', $shift->id)->first();
        if (!$shift_user) {
            return $this->error('Shift Not Exist', 404);
        }
        $shift_user->update([
            'clockout' => now(),
            'shift_status' => 1,
        ]);
        return $this->success('Shift Clockout', 200);
    }
    public function shiftClockin(Request $request, $id)
    {

        $shift = Shift::findOrFail($id);
        // $attributes = $request->validate([
        //     'lat' => ['required'],
        //     'lon' => ['required'],
        //     'location_name' => ['required'],

        // ]);
        $shift_user = UserShift::where('shift_id', $shift->id)->first();
        if (!$shift_user) {
            return $this->error('Shift Not Exist', 404);
        }
        $shift_user->update([
            'clockin' => now(),
            'lat' => $request->lat,
            'lon' => $request->lon,
            'location_name' => $request->location_name,

        ]);
        return $this->success('Shift Clockin', 200);
    }
    public function shiftsFilter(Request $request)
    {
        // Fetch banned facility user IDs and used shift IDs only if they are relevant for filtering
        $facility_ids = BannedFacilityClinician::where('user_id', auth()->id())->pluck('facility_id');
        $bannedFacilityUserIds = Facility::whereIn('id', $facility_ids)->pluck('user_id');
        $usedShiftIds = UserShift::where('user_id', auth()->id())->pluck('shift_id');

        // Build the shifts query with conditional filtering
        $shifts = Shift::whereNotIn('id', $usedShiftIds)
            ->whereNotIn('user_id', $bannedFacilityUserIds)
            ->where('date', '>=', now()->format('Y-m-d'))
            ->when($request->filled('date'), function ($query) use ($request) {
                $query->where('date', '>=', date('Y-m-d', strtotime($request->date)));
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
