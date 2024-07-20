<?php

namespace App\Models\Facilities;

use App\Models\MasterFiles\MFClinicianType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    use HasFactory;
    protected $table = "facilities";

    protected $fillable = ['user_id',    'country_id',    'state_id',    'city_id',    'unit',    'referred_by',    'passcode',    'how_many_unit_need'];

    /**
     * The clinician types that belong to the Facility
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clinician_types(): BelongsToMany
    {
        return $this->belongsToMany(MFClinicianType::class, 'facility_clinician_types', 'facility_id', 'mf_clinician_type_id');
    }

    /**
     * Get all of the clinicianTypes for the Facility
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clinicianTypes(): HasMany
    {
        return $this->hasMany(FacilityClinicianType::class, 'facility_id');
    }
}
