<?php
namespace App\Models;

use App\Models\Shifts\Shift;
use Carbon\Carbon;
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

    public function getClockinAttribute($value)
    {
        $timezone = auth()->user()->timezone ?? config('app.timezone', 'UTC');
        return $value ? Carbon::parse($value, 'UTC')->setTimezone($timezone)->toDateTimeString() : null;
    }

    public function getClockoutAttribute($value)
    {
        $timezone = auth()->user()->timezone ?? config('app.timezone', 'UTC');
        return $value ? Carbon::parse($value, 'UTC')->setTimezone($timezone)->toDateTimeString() : null;
    }

    public function getAcceptedAtAttribute($value)
    {
        $timezone = auth()->user()->timezone ?? config('app.timezone', 'UTC');
        return $value ? Carbon::parse($value, 'UTC')->setTimezone($timezone)->toDateTimeString() : null;
    }

    public function getRejectedAtAttribute($value)
    {
        $timezone = auth()->user()->timezone ?? config('app.timezone', 'UTC');
        return $value ? Carbon::parse($value, 'UTC')->setTimezone($timezone)->toDateTimeString() : null;
    }

    public function getCancelledAtAttribute($value)
    {
        $timezone = auth()->user()->timezone ?? config('app.timezone', 'UTC');
        return $value ? Carbon::parse($value, 'UTC')->setTimezone($timezone)->toDateTimeString() : null;
    }
}
