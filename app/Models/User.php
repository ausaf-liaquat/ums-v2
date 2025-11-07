<?php
namespace App\Models;

use App\Models\Courses\CourseUserSchedule;
use App\Models\Facilities\BannedFacilityClinician;
use App\Models\Facilities\Facility;
use App\Models\Presenters\UserPresenter;
use App\Models\Shifts\Shift;
use App\Models\Traits\HasHashedMediaTrait;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Interfaces\WalletFloat;
use Bavix\Wallet\Traits\HasWalletFloat;
use function Illuminate\Events\queueable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia, MustVerifyEmail, Wallet, WalletFloat
{
    use HasFactory;
    use HasHashedMediaTrait;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;
    use UserPresenter;
    use Billable;

    use HasWalletFloat;
    use HasApiTokens;
    // use SoftDeletes;

    protected $guarded = [
        'id',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $dates = ['deleted_at'];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'date_of_birth'     => 'datetime',
            'last_login'        => 'datetime',
            'deleted_at'        => 'datetime',
            'social_profiles'   => 'array',
        ];
    }

    /**
     * Boot the model.
     *
     * Register the model's event listeners.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // create a event to happen on creating
        static::creating(function ($table) {
            $table->created_by = Auth::id();
        });

        // create a event to happen on updating
        static::updating(function ($table) {
            $table->updated_by = Auth::id();
        });

        // create a event to happen on saving
        static::saving(function ($table) {
            $table->updated_by = Auth::id();
        });

        // create a event to happen on deleting
        static::deleting(function ($table) {
            $table->deleted_by = Auth::id();
            $table->save();
        });
    }

    /**
     * Retrieve the providers associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers()
    {
        return $this->hasMany('App\Models\UserProvider');
    }

    /**
     * Get the list of users related to the current User.
     */
    public function getRolesListAttribute()
    {
        return array_map('intval', $this->roles->pluck('id')->toArray());
    }

    /**
     * Get the facility associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function facility(): HasOne
    {
        return $this->hasOne(Facility::class, 'user_id');
    }

    // public function transactions()
    // {
    //     return $this->hasMany(Transaction::class);
    // }

    public function balance()
    {
        return $this->hasOne(UserAccount::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'uploaded_by');
    }
    /**
     * @return array
     */
    public function prepareData(): array
    {
        return [
            'id'                 => $this->id,
            'first_name'         => $this->first_name ?? 'N/A',
            'last_name'          => $this->last_name ?? 'N/A',
            'email'              => $this->email ?? 'N/A',
            'phone_number'       => $this->phone ?? 'N/A',
            'image_url'          => Storage::disk('cms')->url($this->avatar) ?? 'N/A',
            'unCompleted_shifts' => UserShift::where('user_id', $this->id)->where('status', 1)->where('status', 0)->count() ?? 0,
            'completed_shifts'   => UserShift::where('user_id', $this->id)->where('status', 1)->where('status', 1)->count() ?? 0,
            'address'            => $this->address,
            'state'              => $this->state,
            'city'               => $this->city,
            'zip_code'           => $this->zip_code,
            'timezone'           => $this->timezone,
        ];
    }

    /**
     * Retrieve the bannedFacilities associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bannedFacilities()
    {
        return $this->hasMany(BannedFacilityClinician::class);
    }

    /**
     * Retrieve the user_courses associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_courses()
    {
        return $this->hasMany(CourseUserSchedule::class, 'user_id');
    }

    /**
     * Shift that belong to the User
     */
    public function shifts()
    {
        return $this->hasMany(Shift::class, 'user_id');
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::updated(queueable(function (User $customer) {
            if ($customer->hasStripeId()) {
                try {
                    // Try syncing existing Stripe customer
                    $customer->syncStripeCustomerDetails();
                } catch (\Stripe\Exception\InvalidRequestException $e) {
                    // Handle "No such customer" error
                    if (str_contains($e->getMessage(), 'No such customer')) {
                        // Reset stripe_id and recreate the customer
                        $customer->forceFill(['stripe_id' => null])->save();

                        // Create a new Stripe customer and update stripe_id
                        $customer->createAsStripeCustomer();
                    } else {
                        // Re-throw other errors
                        throw $e;
                    }
                }
            } else {
                // If user doesn't have a stripe_id, create one
                $customer->createAsStripeCustomer();
            }
        }));
    }

}
