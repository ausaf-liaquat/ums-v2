<?php

namespace App\Http\Controllers\Backend\MasterFiles;

use App\Http\Controllers\Controller;
use App\Models\MasterFiles\MFQualificationType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QualificationTypeController extends Controller
{
    public function index(){
        return view('backend.master-files.qualification-types.index');
    }

    public function dataTable(Request $request) {

        $model = MFQualificationType::query();

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }


    public function create(Request $request) {

        $data = [
            'isEdit'=>false,
        ];

        return view('backend.master-files.qualification-types.add', $data);
    }

    public function store(Request $request) {

        MFQualificationType::create([
            'name'=>$request->name
        ]);

        return redirect()->route('backend.qualification-types')->with('success', 'Qualification type added successfully');
    }

    public function edit(MFQualificationType $qualification_type) {

        $data = [
            'isEdit'=>true,
            'qualification_type'=>$qualification_type
        ];

        return view('backend.master-files.qualification-types.add', $data);
    }

    public function update(Request $request,MFQualificationType $qualification_type) {

        $qualification_type->update([
            'name'=>$request->name
        ]);

        return redirect()->route('backend.qualification-types')->with('success', 'Qualification type updated successfully');
    }
    public function status(Request $request) {

        $qualification_type = MFQualificationType::find($request->id);

        $qualification_type->update([
            'status'=>$request->status
        ]);

        return response()->json(200);
    }


    public function destroy(Request $request) {

        $qualification_type = MFQualificationType::find($request->id);

        $qualification_type->delete();
        return response()->json(200);
    }

}
