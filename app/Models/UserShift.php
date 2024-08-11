<?php

namespace App\Models;

use App\Models\Shifts\Shift;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserShift extends Model
{
    use HasFactory;
    protected $table = "clinicians_shifts";

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get the shift that owns the UserShift
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }

     /**
     * Get the clinician that owns the UserShift
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clinician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
