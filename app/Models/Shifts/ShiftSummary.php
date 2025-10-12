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

class ShiftSummary extends Model
{
    use HasFactory;

    protected $table = "shift_summary";

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Get the shift that owns the Shift Summary
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}
