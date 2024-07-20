<?php

namespace App\Http\Controllers\Backend\MasterFiles;

use App\Http\Controllers\Controller;
use App\Models\MasterFiles\MFShiftType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShiftTypeController extends Controller
{
    public function index(){
        return view('backend.master-files.shift-types.index');
    }

    public function dataTable(Request $request) {

        $model = MFShiftType::query();

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }


    public function create(Request $request) {

        $data = [
            'isEdit'=>false,
        ];

        return view('backend.master-files.shift-types.add', $data);
    }

    public function store(Request $request) {

        MFShiftType::create([
            'name'=>$request->name
        ]);

        return redirect()->route('backend.shift-types')->with('success', 'Shift type added successfully');
    }

    public function edit(MFShiftType $shift_type) {

        $data = [
            'isEdit'=>true,
            'shift_type'=>$shift_type
        ];

        return view('backend.master-files.shift-types.add', $data);
    }

    public function update(Request $request,MFShiftType $shift_type) {

        $shift_type->update([
            'name'=>$request->name
        ]);

        return redirect()->route('backend.shift-types')->with('success', 'Shift type updated successfully');
    }
    public function status(Request $request) {

        $shift_type = MFShiftType::find($request->id);

        $shift_type->update([
            'status'=>$request->status
        ]);

        return response()->json(200);
    }


    public function destroy(Request $request) {

        $shift_type = MFShiftType::find($request->id);

        $shift_type->delete();
        return response()->json(200);
    }

}
