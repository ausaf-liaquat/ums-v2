<?php

namespace App\Models\Facilities;

use App\Models\MasterFiles\MFClinicianType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacilityClinicianType extends Model
{
    use HasFactory;

    protected $table = "facility_clinician_types";

    protected $fillable = ['facility_id',    'mf_clinician_type_id'];

     /**
     * Get the shift hour that owns the Shift
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clinician_type(): BelongsTo
    {
        return $this->belongsTo(MFClinicianType::class, 'mf_clinician_type_id');
    }
}
