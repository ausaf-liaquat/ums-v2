<?php

namespace App\Http\Controllers\Backend\Facilities;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('backend.facilities.index');
    }


    public function dataTable(Request $request)
    {

        $model = User::query()->with('facility.facility_clinician_types.clinician_type','wallet')->whereHas('facility');

        return DataTables::eloquent($model)->addIndexColumn()->addColumn("wallet", function (User $user) {
            return "<span class='badge bg-label-success mb-2'>$". $user->wallet->balanceFloat. "</span>";
        })->rawColumns(['wallet'])->make(true);
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $facility)
    {
        $data = [
            'isEdit' => true,
            'facility'=>$facility
        ];

        return view('backend.facilities.add', $data);
    }
}
