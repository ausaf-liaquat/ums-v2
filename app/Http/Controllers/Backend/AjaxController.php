<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Courses\CourseSchedule;
use App\Models\Products\Product;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function productNameValidator(Request $request)
    {
        $product_name = $request->product_name;

        $exists = Product::where('title', $product_name)->exists();

        return response()->json(['is_unique' => !$exists]);
    }

    public function shiftAutocomplete(Request $request)
    {
        $client = new Client([
            'base_uri' => 'https://nominatim.openstreetmap.org/',
            'headers' => [
                'User-Agent' => 'UniqueMedSCVS/1.0 (your-email@example.com)',
            ],
        ]);

        $response = $client->get('search', [
            'query' => [
                'q' => $request->input('q') . ', USA',
                'format' => 'json',
                'addressdetails' => 1,
                'limit' => 10,
            ],
        ]);

        $data = [];
        $results = json_decode($response->getBody(), true);
        foreach ($results as $result) {
            $text = $result['display_name'];
            $data[] = [
                'id' => $text,
                'text' => $text,
                'completeAddress' => $text,
                'latitude' => $result['lat'],
                'longitude' => $result['lon'],
            ];
        }

        return response()->json(['results' => $data]);
    }

    public function getDates(Request $request)
    {
        $date = Carbon::parse($request->date)->format('Y-m-d');
        // $formattedDate = Carbon::parse($request->date)->format('Y-m-d');
        // $course = Course::find($request->course_id);
        $slots = CourseSchedule::where('course_id', $request->course_id)->whereDate('datetime', $date)->count();
        $event = CourseSchedule::where('course_id', $request->course_id)->whereDate('datetime', $date)->withCount('user_courses')->with('course')->get();
        return response()->json(['event' => $event, 'slots' => $slots], 200);
    }
}
