<?php

namespace App\Models\Facilities;

use App\Models\City;
use App\Models\Country;
use App\Models\MasterFiles\MFClinicianType;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    use HasFactory;
    protected $table = "facilities";

    protected $fillable = ['user_id',    'country_id',    'state_id',    'city_id',    'unit',    'referred_by',    'passcode', 'zip_code',    'how_many_unit_need'];

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
    public function facility_clinician_types(): HasMany
    {
        return $this->hasMany(FacilityClinicianType::class, 'facility_id');
    }

     /**
     * Get the country that owns the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    /**
     * Get the state that owns the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    /**
     * Get the city that owns the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
