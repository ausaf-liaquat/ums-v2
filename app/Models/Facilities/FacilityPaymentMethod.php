<?php

namespace App\Models\Facilities;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacilityPaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'facility_payment_methods';

    protected $fillable = [
        'facility_id',
        'stripe_payment_method_id',
        'bank_name',
        'routing_number',
        'account_number',
        'first',
        'middle',
        'last',
        'card_type',
        'card_number',
        'exp_month',
        'exp_year',
        'security_code',
        'billing_address_1',
        'billing_address_2',
        'city_id',
        'state_id',
        'country_id',
        'zip_code',
        'status'
    ];

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
