<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Courses\CourseSchedule;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Retrieves the view for the index page of the frontend.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }

    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function privacy()
    {
        return view('frontend.privacy');
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function terms()
    {
        return view('frontend.terms');
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function services()
    {
        return view('frontend.services');
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function aboutUs()
    {
        return view('frontend.about-us');
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function careers()
    {
        return view('frontend.careers');
    }

     /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function courses()
    {
        $data = [
            'courses'=>Course::whereStatus(1)->get()
        ];
        return view('frontend.course', $data);
    }

    public function courseRegister($slug, Request $request)
    {

        $course = Course::whereSlug($slug)->first();
        if (auth()->check()) {
           if (auth()->user()->hasRole('super admin') || auth()->user()->hasRole('facility')) {
                session()->flush();
                auth()->logout();
            }
        }
        $databaseDates = CourseSchedule::where('course_id', $course->id)->pluck('datetime')->toArray();
        if ($course->type == 1) {
            return view('frontend.course-checkout', compact('course'));
        } else {
            return view('frontend.course-register', compact('course', 'databaseDates'));
        }
    }
}
