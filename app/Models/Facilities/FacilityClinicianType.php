<?php

namespace App\Models\Facilities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityClinicianType extends Model
{
    use HasFactory;

    protected $table = "facility_clinician_types";

    protected $fillable = ['facility_id',    'mf_clinician_type_id'];
}
