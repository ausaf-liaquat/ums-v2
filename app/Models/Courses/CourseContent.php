<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class CourseContent extends Model
{
    public $table = 'course_contents';

    public $fillable = [
        'course_id',
        'content',
        'heading',
    ];

    /**
     * Get all of the links for the CourseContent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links(): HasMany
    {
        return $this->hasMany(CourseLink::class, 'course_content_id');
    }

}
