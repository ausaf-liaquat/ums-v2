<?php

namespace App\Http\Controllers\Backend\Courses;

use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Courses\CourseContent;
use App\Models\Courses\CourseLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.courses.index'); //
    }


    public function dataTable(Request $request)
    {

        $model = Course::query();

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'isEdit' => false,
        ];

        return view('backend.courses.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $course =   Course::create([
            'name' => $request->course_name,
            'slug' => $request->slug,
            'description' => $request->description,
            'address' => $request->address,
            'price' => $request->course_price,
            'zip_code' => $request->zip_code,
            'type' => $request->course_type,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
        ]);

        $file = null;

        // Check if the request has file
        if ($request->hasFile('image')) {
            $path = Storage::disk('cms')->put('', $request->file('image'));
            $file = $path; // Collect file paths
        }

        $course->update(['image' => $file]);

        return redirect()->route('backend.courses')->with('success', 'Courses added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $data = [
            'isEdit' => true,
            'course' => $course
        ];

        return view('backend.courses.add', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
// dd($request->all());
        $course->update([
            'name' => $request->course_name,
            'slug' => $request->slug,
            'description' => $request->description,
            'address' => $request->address,
            'price' => $request->course_price,
            'zip_code' => $request->zip_code,
            'type' => $request->course_type,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'is_upload_card' => $request->is_upload_card??0,
        ]);

        if ($request->file('image') && $course->image) {
            Storage::disk('cms')->delete($course->image);
        }

        $file = null;

        // Check if the request has file
        if ($request->hasFile('image')) {
            $path = Storage::disk('cms')->put('', $request->file('image'));
            $file = $path; // Collect file paths
        }

        $course->update(['image' => $file]);

        return redirect()->route('backend.courses')->with('success', 'Courses updated successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function content(Course $course)
    {
        $data = [
            'isEdit' => true,
            'course' => $course
        ];

        return view('backend.courses.content', $data);
    }
    public function contentUpdate(Course $course, Request $request)
    {
        // dd($course);

        $course_content = CourseContent::where('course_id', $course->id)->first();

        if ($course_content) {
            CourseLink::where('course_content_id', $course_content->id)->delete();
            $course_content->update([
                'content' => $request->content
            ]);
        } else {
            CourseContent::create([
                'course_id' => $course->id,
                'content' => $request->content
            ]);
        }
        if ($request->heading) {
            foreach ($request->heading ?? [] as $key => $value) {
                if ($value) {
                    CourseLink::create([
                        'course_content_id' => $course_content->id,
                        'heading' => $value,
                        'link' => $request->link[$key]
                    ]);
                }
            }
        }

        return redirect()->route('backend.courses')->with('success', 'Course Content updated successfully');
    }

    public function status(Request $request)
    {

        $course = Course::find($request->id);

        $course->update([
            'status' => $request->status
        ]);

        return response()->json(200);
    }


    public function destroy(Request $request)
    {

        $course = Course::find($request->id);

        $course->delete();
        return response()->json(200);
    }
}
