<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facilities\BannedFacilityClinician;
use App\Models\Facilities\Facility;
use App\Models\Shifts\Shift;
use App\Models\Traits\ApiResponser;
use App\Models\UserShift;
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
        })->with(['clinician_type','shift_hour','mfshift_types.types'])->get();

        return $this->success(['shifts' => $shifts], 'Shifts', 200);
    }
    public function acceptedShifts()
    {
        $usedShifts_ids = UserShift::where('user_id', auth()->user()->id)->where('status', 1)->pluck('shift_id')->toArray();
        $shifts = Shift::where('date', '>=', now()->format('Y-m-d'))->whereIn('id', $usedShifts_ids)->with(['clinician_type','shift_hour','mfshift_types.types'])->get();

        return $this->success(['shifts' => $shifts], 'Clinicians Shifts', 200);
    }
    public function shiftDetail($id)
    {
        $shift = Shift::find($id)->load(['clinician_type','shift_hour','mfshift_types.types']);

        return $this->success(['shift' => $shift], 'Shift Details', 200);
    }
    public function shiftAccept($id)
    {
        $shift = Shift::findOrFail($id);

        UserShift::create([
            'user_id'     => auth()->user()->id,
            'shift_id'    => $shift->id,
            'status'      => 1,
            'accepted_at' => now(),
            // 'clockin'     => now(),
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
            'shift_id' => $shift->id
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
        $attributes = $request->validate([
            'lat' => ['required'],
            'lon' => ['required'],
            'location_name' => ['required'],

        ]);
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
        $shifts = Shift::where(function ($q) use ($request) {
            $q->where('date', date('Y-m-d', strtotime($request->date)))->orWhere('shift_hour', $request->shift_hour)->orWhere('clinician_type', $request->type);
        })->with(['clinician_type','shift_hour','mfshift_types.types'])->get();

        return $this->success($shifts, 'Shifts', 200);
    }
}
