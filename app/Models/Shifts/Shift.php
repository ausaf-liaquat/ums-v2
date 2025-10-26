<?php

namespace App\Models\Shifts;

use App\Models\MasterFiles\MFClinicianType;
use App\Models\MasterFiles\MFShiftHour;
use App\Models\MasterFiles\MFShiftType;
use App\Models\User;
use App\Models\UserShift;
use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Interfaces\ProductInterface;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Traits\HasWalletFloat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model implements ProductInterface
{
    use HasFactory;
    use HasWallet;
    use SoftDeletes;

    protected $table = "shifts";

    protected $guarded = ['id', 'created_at', 'updated_at'];
    // protected $fillable = [
    //     'user_id',
    //     'mf_clinician_type_id',
    //     'mf_shift_hour_id',
    //     'country_id',
    //     'state_id',
    //     'city_id',
    //     'title',
    //     'date',
    //     'shift_hour',
    //     'rate_per_hour',
    //     'total_amount',
    //     'additional_comments',
    //     'address',
    //     'zip_code',
    //     'status',
    // ];

    /**
     * The shift_types that belong to the Shift
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function shift_types(): BelongsToMany
    {
        return $this->belongsToMany(MFShiftType::class, 'shift_shift_types', 'shift_id', 'mf_shift_type_id');
    }

    public function getAmountProduct(Customer $customer): int
    {
        return $this->total_amount * 100;
    }

    public function getMetaProduct(): ?array
    {
        return [
            'title' => $this->title,
            'description' => 'Purchase of Shift #' . $this->id,
        ];
    }

    // /**
    //  * Get the clinician type that owns the Shift
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function clinician_type(): BelongsTo
    // {
    //     return $this->belongsTo(MFClinicianType::class, 'mf_clinician_type_id');
    // }
    // /**
    //  * Get the shift hour that owns the Shift
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function shift_hour(): BelongsTo
    // {
    //     return $this->belongsTo(MFShiftHour::class, 'mf_shift_hour_id');
    // }

     /**
     * Get all of the clinicianTypes for the Facility
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mfshift_types(): HasMany
    {
        return $this->hasMany(ShiftShiftType::class, 'shift_id');
    }

    /**
     * Get all of the clinicianTypes for the Facility
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shift_clinicians(): HasMany
    {
        return $this->hasMany(UserShift::class, 'shift_id');
    }

    /**
     * Get the user that owns the Shift
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
