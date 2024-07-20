<?php

namespace App\Models\MasterFiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MFClinicianType extends Model
{
    use HasFactory;

    protected $table = "mf_clinician_types";

    protected $fillable =['name', 'status'];
}
