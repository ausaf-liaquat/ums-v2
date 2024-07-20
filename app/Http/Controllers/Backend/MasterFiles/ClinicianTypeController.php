<?php

namespace App\Http\Controllers\Backend\MasterFiles;

use App\Http\Controllers\Controller;
use App\Models\MasterFiles\MFClinicianType;
use App\Models\MasterFiles\MFQualificationType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClinicianTypeController extends Controller
{
    public function index(){
        return view('backend.master-files.clinician-types.index');
    }

    public function dataTable(Request $request) {

        $model = MFClinicianType::query();

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }


    public function create(Request $request) {

        $data = [
            'isEdit'=>false,
        ];

        return view('backend.master-files.clinician-types.add', $data);
    }

    public function store(Request $request) {

        MFClinicianType::create([
            'name'=>$request->name
        ]);

        return redirect()->route('backend.clinician-types')->with('success', 'Clinician type added successfully');
    }

    public function edit(MFClinicianType $clinician_type) {

        $data = [
            'isEdit'=>true,
            'clinician_type'=>$clinician_type
        ];

        return view('backend.master-files.clinician-types.add', $data);
    }

    public function update(Request $request,MFClinicianType $clinician_type) {

        $clinician_type->update([
            'name'=>$request->name
        ]);

        return redirect()->route('backend.clinician-types')->with('success', 'Clinician type updated successfully');
    }
    public function status(Request $request) {

        $clinician_type = MFClinicianType::find($request->id);

        $clinician_type->update([
            'status'=>$request->status
        ]);

        return response()->json(200);
    }


    public function destroy(Request $request) {

        $clinician_type = MFClinicianType::find($request->id);

        $clinician_type->delete();
        return response()->json(200);
    }

}
