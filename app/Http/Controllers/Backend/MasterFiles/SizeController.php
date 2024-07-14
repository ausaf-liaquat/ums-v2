<?php

namespace App\Http\Controllers\Backend\MasterFiles;

use App\Http\Controllers\Controller;
use App\Models\MasterFiles\MFSize;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
    public function index(){
        return view('backend.master-files.sizes.index');
    }

    public function dataTable(Request $request) {

        $model = MFSize::query();

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }


    public function create(Request $request) {

        $data = [
            'isEdit'=>false,
        ];

        return view('backend.master-files.sizes.add', $data);
    }

    public function store(Request $request) {

        MFSize::create([
            'name'=>$request->name
        ]);

        return redirect()->route('backend.sizes')->with('success', 'Size added successfully');
    }

    public function edit(MFSize $size) {

        $data = [
            'isEdit'=>true,
            'size'=>$size
        ];

        return view('backend.master-files.sizes.add', $data);
    }

    public function update(Request $request,MFSize $size) {

        $size->update([
            'name'=>$request->name
        ]);

        return redirect()->route('backend.sizes')->with('success', 'Size updated successfully');
    }
    public function status(Request $request) {

        $size = MFSize::find($request->id);

        $size->update([
            'status'=>$request->status
        ]);

        return response()->json(200);
    }


    public function destroy(Request $request) {

        $size = MFSize::find($request->id);

        $size->delete();
        return response()->json(200);
    }
}
