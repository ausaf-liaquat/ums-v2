<?php

namespace App\Models\Facilities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedFacilityClinician extends Model
{
    use HasFactory;

    protected $table= "banned_facility_clinicians";

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
