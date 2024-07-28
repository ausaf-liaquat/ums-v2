<?php

namespace App\Models\Courses;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class CourseSchedule extends Model
{
    public $table = 'course_schedules';

    public $fillable = [
        'course_id',
        'country_id',
        'state_id',
        'city_id',
        'datetime',
        'slot',
        'description',
        'address',
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

    /**
     * Get the course that owns the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }


    /**
     * Get all of the user_courses for the CourseSchedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_courses(): HasMany
    {
        return $this->hasMany(CourseUserSchedule::class, 'course_schedule_id');
    }
}
