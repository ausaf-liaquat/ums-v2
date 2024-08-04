<?php

namespace App\Http\Controllers\Backend\MasterFiles;

use App\Http\Controllers\Controller;
use App\Models\MasterFiles\MFColor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    public function index(){
        return view('backend.master-files.colors.index');
    }

    public function dataTable(Request $request) {

        $model = MFColor::query();

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }


    public function create(Request $request) {

        $data = [
            'isEdit'=>false,
        ];

        return view('backend.master-files.colors.add', $data);
    }

    public function store(Request $request) {

        MFColor::create([
            'name'=>$request->name,
            'color'=>$request->color
        ]);

        return redirect()->route('backend.colors')->with('success', 'Color added successfully');
    }

    public function edit(MFColor $color) {

        $data = [
            'isEdit'=>true,
            'color'=>$color
        ];

        return view('backend.master-files.colors.add', $data);
    }

    public function update(Request $request,MFColor $color) {

        $color->update([
            'name'=>$request->name,
            'color'=>$request->color

        ]);

        return redirect()->route('backend.colors')->with('success', 'Color updated successfully');
    }
    public function status(Request $request) {

        $color = MFColor::find($request->id);

        $color->update([
            'status'=>$request->status
        ]);

        return response()->json(200);
    }


    public function destroy(Request $request) {

        $color = MFColor::find($request->id);

        $color->delete();
        return response()->json(200);
    }

}
