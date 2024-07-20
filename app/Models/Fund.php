<?php

namespace App\Models;

use App\Models\Facilities\FacilityPaymentMethod;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fund extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table= "funds";

    protected $fillable = [
        'user_id',
        'transaction_id',
        'facility_payment_method_id',
        'datetime',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(FacilityPaymentMethod::class, 'facility_payment_method_id');
    }

    /**
     * Get all of the transactions for the Fund
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
