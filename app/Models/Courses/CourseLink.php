<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CourseLink extends Model
{
    public $table = 'course_content_links';

    public $fillable = [
        'course_content_id',
        'heading',
        'link'
    ];

}
