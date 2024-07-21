<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\MasterFiles\MFClinicianType;
use App\Models\MasterFiles\MFQualificationType;
use App\Models\MasterFiles\MFShiftHour;
use App\Models\MasterFiles\MFShiftType;
use App\Models\State;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    public function countriesSelect2(Request $request)
    {
        $countries = Country::query()
            ->when($request->q, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->q}%");
            })
            ->limit(10)
            ->get(['id', 'name as text']);

        return ['results' => $countries];
    }

    public function statesSelect2(Request $request)
    {
        $states = State::query()
            ->when($request->q, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->q}%");
            })
            ->where('country_id', $request->country_id)->limit(10)->get(['id', 'name as text']);

        return ['results' => $states];
    }

    public function citiesSelect2(Request $request)
    {
        $cities = City::query()
            ->when($request->q, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->q}%");
            })->where('state_id', $request->state_id)->where('country_id', $request->country_id)->limit(10)->get(['id', 'name as text']);

        return ['results' => $cities];
    }

    public function qualificationTypesSelect2(Request $request)
    {
        $qualificationTypes = MFQualificationType::query()
            ->when($request->q, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->q}%");
            })->limit(10)->get(['id', 'name as text']);

        return ['results' => $qualificationTypes];
    }

    public function shiftTypesSelect2(Request $request)
    {
        $shiftTypes = MFShiftType::query()
            ->when($request->q, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->q}%");
            })->limit(10)->get(['id', 'name as text']);

        return ['results' => $shiftTypes];
    }

    public function clinicianTypesSelect2(Request $request)
    {
        $clinicianTypes = MFClinicianType::query()
            ->when($request->q, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->q}%");
            })->limit(10)->get(['id', 'name as text']);

        return ['results' => $clinicianTypes];
    }
    public function shiftHourSelect2(Request $request)
    {
        $shiftHours = MFShiftHour::query()
            ->when($request->q, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->q}%");
            })
            ->limit(10)
            ->get();

        $results = $shiftHours->map(function ($shiftHour) {
            return [
                'id' => $shiftHour->id,
                'text' => $shiftHour->name,
                'shift_total_hour' => $shiftHour->shift_total_hours, // Assuming total_hour is a field or an accessor method
            ];
        });

        return response()->json(['results' => $results]);
    }
}
