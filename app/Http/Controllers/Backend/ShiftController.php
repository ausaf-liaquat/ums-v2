<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facilities\FacilityClinicianType;
use App\Models\MasterFiles\MFClinicianType;
use App\Models\MasterFiles\MFShiftHour;
use App\Models\Shifts\Shift;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $model = Shift::query()->with('clinician_type', 'shift_hour','mfshift_types.types')->where('user_id', auth()->user()->id);

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'isEdit' => false,
            'clinicianTypes' => MFClinicianType::whereStatus(1)->get(),
            'shiftHours' => MFShiftHour::whereStatus(1)->get(),
        ];

        return view('backend.shifts.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user           = Auth::user();
        if ($request->total_amount > $user->wallet->balanceFloatNum) {
            return redirect()->back()->with('error', 'You do not have enough balance to create this shift');
        }

        DB::beginTransaction();

        try {
            $shift = Shift::create([
                'user_id'              => $user->id,
                'title'                => $request->title,
                'address'              => $request->shift_location,
                'mf_clinician_type_id' => $request->mf_clinician_type_id,
                'mf_shift_hour_id'     => $request->shift_hour_id,
                'date'                 => $request->date,
                'rate_per_hour'        => $request->rate_per_hour,
                'total_amount'         => $request->total_amount,
                'additional_comments'   => $request->additional_comment
            ]);
            $shift->shift_types()->sync($request->mf_shift_type_id);

            $user->wallet->pay($shift);

            DB::commit();

            return redirect()->route('backend.shifts')->with('success', 'Shift created successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error',  $e->getMessage());
        }

        return redirect()->route('backend.shifts')->with('success', 'Shift created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        $data = [
            'isEdit' => true,
            'shift'=>$shift,
            'clinicianTypes' => MFClinicianType::whereStatus(1)->get(),
            'shiftHours' => MFShiftHour::whereStatus(1)->get(),
        ];

        return view('backend.shifts.add', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shift $shift)
    {

        $shift->update([
            'title'                => $request->title,
            'address'              => $request->shift_location,
            'mf_clinician_type_id' => $request->mf_clinician_type_id,
            'date'                 => $request->date,
            'additional_comments'   => $request->additional_comment
        ]);

        $shift->shift_types()->sync($request->mf_shift_type_id);

        return redirect()->route('backend.shifts')->with('success', 'Shift updated successfully');
    }

    public function status(Request $request)
    {


        return response()->json(200);
    }


    public function destroy(Request $request)
    {

        $shift = Shift::find($request->id);

        $shift->delete();
        return response()->json(200);
    }
}
