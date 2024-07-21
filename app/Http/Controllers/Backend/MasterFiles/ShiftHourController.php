<?php

namespace App\Http\Controllers\Backend\MasterFiles;

use App\Http\Controllers\Controller;
use App\Models\MasterFiles\MFShiftHour;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShiftHourController extends Controller
{
    public function index(){
        return view('backend.master-files.shift-hours.index');
    }

    public function dataTable(Request $request) {

        $model = MFShiftHour::query();

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }


    public function create(Request $request) {

        $data = [
            'isEdit'=>false,
        ];

        return view('backend.master-files.shift-hours.add', $data);
    }

    public function store(Request $request) {

        MFShiftHour::create([
            'name'=>$request->name,
            'shift_total_hours'=>$request->shift_total_hours
        ]);

        return redirect()->route('backend.shift-hours')->with('success', 'Shift hour added successfully');
    }

    public function edit(MFShiftHour $shift_hour) {

        $data = [
            'isEdit'=>true,
            'shift_hour'=>$shift_hour
        ];

        return view('backend.master-files.shift-hours.add', $data);
    }

    public function update(Request $request,MFShiftHour $shift_hour) {

        $shift_hour->update([
            'name'=>$request->name,
            'shift_total_hours'=>$request->shift_total_hours
        ]);

        return redirect()->route('backend.shift-hours')->with('success', 'Shift hour updated successfully');
    }
    public function status(Request $request) {

        $shift_hour = MFShiftHour::find($request->id);

        $shift_hour->update([
            'status'=>$request->status
        ]);

        return response()->json(200);
    }


    public function destroy(Request $request) {

        $shift_hour = MFShiftHour::find($request->id);

        $shift_hour->delete();
        return response()->json(200);
    }

}
