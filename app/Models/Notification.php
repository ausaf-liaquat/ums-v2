<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Notification
 *
 * @property int $id
 * @property int $type
 * @property int $notification_for
 * @property int $user_id
 * @property string $title
 * @property string|null $text
 * @property string|null $meta
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotificationFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
 * @mixin \Eloquent
 */
class Notification extends Model
{
    /**
     * @var string
     */
    public $table = 'notifications';

    /**
     * @var string[]
     */
    public $fillable = [
        'type',
        'notification_for',
        'user_id',
        'title',
        'text',
        'meta',
        'read_at',
    ];

    protected $casts = [
        'id'               => 'integer',
        'type'             => 'string',
        'notification_for' => 'string',
        'user_id'          => 'integer',
        'title'            => 'string',
        'text'             => 'string',
        'meta'             => 'array',
        'read_at'          => 'string',
    ];

    const SUPER_ADMIN = 'super admin';
    const CLINICIAN   = 'clinician';
    const FACILITY    = 'facility';

    const NOTIFICATION_FOR = [
        self::SUPER_ADMIN => 1,
        self::FACILITY    => 2,
        self::CLINICIAN   => 3,
    ];

    const NOTIFICATION_TYPE = [
        'Shifts' => 1
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
