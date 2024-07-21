<?php

namespace App\Models\Shifts;

use App\Models\MasterFiles\MFShiftType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShiftShiftType extends Model
{
    use HasFactory;

    protected $table = "shift_shift_types";

    protected $fillable = ['shift_id','mf_shift_type_id'];

        /**
     * Get the shift type that owns the Shift
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function types(): BelongsTo
    {
        return $this->belongsTo(MFShiftType::class, 'mf_shift_type_id');
    }
}
