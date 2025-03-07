<?php

namespace App\Http\Controllers\Backend\Courses;

use App\Http\Controllers\Controller;
use App\Models\Courses\CourseUserSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CourseRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.courses.course-registrations.index'); //
    }

    public function dataTable(Request $request)
    {

        $model = CourseUserSchedule::query()->with('user', 'course', 'course_schedule')->latest();

        return DataTables::eloquent($model)->addIndexColumn()->addColumn('course_schedule', function (CourseUserSchedule $course_user_schedule) {
            $date = $course_user_schedule?->course_schedule?->datetime ? Carbon::parse($course_user_schedule->course_schedule->datetime)->format('F j, Y h:i A')
            : 'N/A';

            $slot = $course_user_schedule?->course_schedule?->slot ?? 'N/A';
            $address = $course_user_schedule?->course_schedule?->address ?? 'N/A';

            if ($course_user_schedule?->course_schedule) {

                return "Schedule Date: $date<br>Slot: $slot<br>Address: $address";
            } else {
                return "";
            }

        })->rawColumns(['course_schedule'])->make(true);
    }

}
