<?php

namespace App\Http\Controllers\Backend\Courses;

use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Courses\CourseContent;
use App\Models\Courses\CourseLink;
use App\Models\Courses\CourseSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CourseScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $data = [
            'course' => $course
        ];
        return view('backend.courses.schedules.index', $data); //
    }


    public function dataTable(Request $request)
    {

        $model = CourseSchedule::query()->where('course_id', $request->course_id);

        return DataTables::eloquent($model)->addIndexColumn()->addColumn('datetime', function (CourseSchedule $course_schedule) {
            $date = Carbon::parse($course_schedule->datetime);
            return $date->format('F j, Y h:i A');
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        $data = [
            'isEdit' => false,
            'course' => $course
        ];

        return view('backend.courses.schedules.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $course =   CourseSchedule::create([
            'course_id' => $request->course_id,
            'datetime' => $request->datetime,
            'description' => $request->description,
            'address' => $request->address,
            'slot' => $request->slot,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
        ]);

        return redirect()->route('backend.course-schedules', ['course' => $request->course_id])->with('success', 'Course schedule added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseSchedule $course_schedule)
    {
        $data = [
            'isEdit' => true,
            'course_schedule' => $course_schedule,
            'course' => $course_schedule->course
        ];

        return view('backend.courses.schedules.add', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseSchedule $course_schedule)
    {

        $course_schedule->update([
            'datetime' => $request->datetime,
            'description' => $request->description,
            'address' => $request->address,
            'slot' => $request->slot,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
        ]);


        return redirect()->route('backend.course-schedules', ['course' => $request->course_id])->with('success', 'Course schedule updated successfully');
    }

    public function status(Request $request)
    {

        $course_schedule = CourseSchedule::find($request->id);

        $course_schedule->update([
            'status' => $request->status
        ]);

        return response()->json(200);
    }


    public function destroy(Request $request)
    {

        $course_schedule = CourseSchedule::find($request->id);

        $course_schedule->delete();
        return response()->json(200);
    }
}
