<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MasterFiles\MFClinicianType;
use App\Models\MasterFiles\MFShiftHour;
use App\Models\Notification;
use App\Models\Shifts\Shift;
use App\Models\User;
use App\Models\UserShift;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.shifts.index'); //
    }

    public function dataTable(Request $request)
    {

        $model = Shift::query()->with('user')
            ->when(auth()->user()->hasRole('facility'), function ($q) {
                $q->where('user_id', auth()->user()->id);
            })->latest();

        return DataTables::eloquent($model)
        // ->addIndexColumn()
            ->addColumn('date', function (Shift $shift) {
                $date = Carbon::parse($shift->date);
                return $date->format('F j, Y');
            })->addColumn('mfshift_types', function (Shift $shift) {
            $data = $shift->shift_note ? implode(', ', json_decode($shift->shift_note)) : 'N/A';
            return $data;
        })->make(true);
    }
    public function dataTableAcceptedClinicians(Request $request)
    {

        $model = UserShift::query()->with('shift.user', 'clinician')
            ->where('shift_id', $request->shift_id)->where('status', 1);

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->addColumn('accepted_at', function (UserShift $userShift) {
                $date = $userShift->accepted_at ? Carbon::parse($userShift->accepted_at)->format('F j, Y h:i A') : 'N/A';
                return $date;
            })
            ->addColumn('clockin', function (UserShift $userShift) {
                $date = $userShift->clockin ? Carbon::parse($userShift->clockin)->format('F j, Y h:i A') : 'N/A';
                return $date;
            })
            ->addColumn('clockout', function (UserShift $userShift) {
                $date = $userShift->clockout ? Carbon::parse($userShift->clockout)->format('F j, Y h:i A') : 'N/A';
                return $date;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'isEdit'         => false,
            'clinicianTypes' => MFClinicianType::whereStatus(1)->get(),
            'shiftHours'     => MFShiftHour::whereStatus(1)->get(),
        ];

        return view('backend.shifts.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        if ($request->total_amount > $user->wallet->balanceFloatNum) {
            return redirect()->back()->with('error', 'You do not have enough balance to create this shift');
        }

        DB::beginTransaction();

        try {
            $shift = Shift::create([
                'user_id'             => $user->id,
                'title'               => $request->title,
                'shift_location'      => $request->shift_location,
                'clinician_type'      => $request->clinician_type,
                'shift_hour'          => $request->shift_hour,
                'actual_shift_hour'   => $request->actual_shift_hour,
                'shift_note'          => json_encode($request->mf_shift_type_id),
                'date'                => $request->date,
                'rate_per_hour'       => $request->rate_per_hour,
                'service_fee'         => config('ums.shift_service_fee'),
                'holding_fee'         => config('ums.shift_holding_fee'),
                'total_amount'        => $request->total_amount,
                'additional_comments' => $request->additional_comment,
                // 'mf_shift_hour_id'    => $request->shift_hour_id,
                // 'mf_clinician_type_id' => $request->mf_clinician_type_id,
            ]);
            // $shift->shift_types()->sync($request->mf_shift_type_id);

            $user->wallet->pay($shift);

            $cliniciansNotification = User::whereHas('roles', function ($q) {
                $q->where('name', 'clinician');
            })->pluck('id')->toArray();

            $userIds = [];
            foreach ($cliniciansNotification as $key => $userId) {
                $userIds[$userId] = Notification::NOTIFICATION_FOR[Notification::CLINICIAN];
            }
            $users = getAllNotificationUser($userIds);

            foreach ($users as $key => $notification) {
                if (isset($key)) {
                    addNotification([
                        Notification::NOTIFICATION_TYPE['Shifts'],
                        $key,
                        $notification,
                        'Can you work at: ' . $shift->title . ' ' . date('m/d/Y', strtotime($shift->date)) . ' E: ' . $shift->shift_hour . ' as an ' . $shift->clinician_type . '? Pay Rate: ' . $shift->rate_per_hour . '/hour',
                        $shift,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('backend.shifts')->with('success', 'Shift created successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('backend.shifts')->with('success', 'Shift created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        $data = [
            'isEdit'         => true,
            'shift'          => $shift,
            'clinicianTypes' => MFClinicianType::whereStatus(1)->get(),
            'shiftHours'     => MFShiftHour::whereStatus(1)->get(),
        ];

        return view('backend.shifts.add', $data);
    }

    /**
     * Show the form for accepted the specified resource.
     */
    public function acceptedClinicians(Shift $shift)
    {
        $data = [
            'shift' => $shift,
        ];

        return view('backend.shifts.list', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shift $shift)
    {

        $shift->update([
            // 'mf_clinician_type_id' => $request->mf_clinician_type_id,
            'additional_comments' => $request->additional_comment,
            'title'               => $request->title,
            'shift_location'      => $request->shift_location,
            // 'clinician_type' => $request->clinician_type,
            // 'shift_hour' => $request->shift_hour,
            'shift_note'          => json_encode($request->mf_shift_type_id),
            // 'date' => $request->date,
        ]);

        // $shift->shift_types()->sync($request->mf_shift_type_id);

        return redirect()->route('backend.shifts')->with('success', 'Shift updated successfully');
    }

    public function status(Request $request)
    {

        return response()->json(200);
    }

    public function destroy(Request $request)
    {
        $shift = Shift::with('user', 'shift_clinicians')->findOrFail($request->id);

        // ❌ 1. Stop deletion if any clinician already accepted this shift
        $isAccepted = $shift->shift_clinicians()
            ->where('status', 1)
            ->exists();

        if ($isAccepted) {
            return response()->json([
                'success' => false,
                'message' => 'Shift cannot be deleted because it has already been accepted by a clinician.',
            ], 400);
        }

        DB::beginTransaction();

        try {
            // ✅ 2. Check if shift is still available (future date + not accepted)
            $isAvailable = Shift::where('id', $shift->id)
                ->whereDate('date', '>=', now()->format('Y-m-d'))
                ->whereDoesntHave('shift_clinicians', function ($q) {
                    $q->where('status', 1);
                })
                ->exists();

            // ✅ 3. If available → refund the charged amount
            if ($isAvailable && $shift->user) {
                $refundAmount = $shift->total_amount ?? 0;

                if ($refundAmount > 0) {
                    $shift->user->depositFloat($refundAmount, [
                        'type'        => 'shift_refund',
                        'shift_id'    => $shift->id,
                        'description' => 'Shift cancelled while still available in UMS app',
                    ]);
                }
            }

            // ✅ 4. Delete related clinicians and shift itself
            $shift->shift_clinicians()->delete();
            $shift->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $isAvailable
                    ? 'Shift cancelled and refund issued to facility balance.'
                    : 'Shift cancelled. No refund applicable.',
            ], 200);

        } catch (Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong during cancellation: ' . $e->getMessage(),
            ], 500);
        }
    }

}
