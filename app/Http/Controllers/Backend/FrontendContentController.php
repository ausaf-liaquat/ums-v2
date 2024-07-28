<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FrontendContents\FrontendContent;
use App\Models\FrontendContents\FrontendPage;
use App\Models\MasterFiles\MFContentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class FrontendContentController extends Controller
{
    public function index()
    {
        return view('backend.frontend-contents.index');
    }

    public function dataTable(Request $request)
    {

        $model = FrontendPage::query()->whereStatus(1);

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }


    public function create(Request $request)
    {

        $data = [
            'isEdit' => false,
            'content_types' => MFContentType::whereStatus(1)->get()
        ];

        return view('backend.frontend-contents.add', $data);
    }

    public function store(Request $request)
    {

        FrontendPage::create([
            'name' => $request->name
        ]);

        return redirect()->route('backend.frontend-contents')->with('success', 'Frontend content added successfully');
    }

    public function edit(FrontendPage $frontend_page)
    {

        $data = [
            'isEdit' => true,
            'frontend_page' => $frontend_page,
            'content_types' => MFContentType::whereStatus(1)->get()
        ];

        return view('backend.frontend-contents.add', $data);
    }

    public function update(Request $request, FrontendPage $frontend_page)
    {

        // dd($request->all());

        // $frontend_page->update([
        //     'name'=>$request->name
        // ]);

        $frontend_page->contents()->delete();
        foreach ($request->content_type_id ?? [] as $key => $value) {
            $frontend_content =  FrontendContent::create([
                'mf_content_type_id' => $value,
                'frontend_page_id'   => $frontend_page->id,
                'content_title'       => $request->content_title[$key],
                'content_text'       => $request->content_text[$key]
            ]);

            if ($request->hasFile('content_file.' . $key)) {
                // Delete the old file if exists
                if ($request->existing_content_file[$key] && Storage::disk('cms')->exists($request->existing_content_file[$key])) {
                    Storage::disk('cms')->delete($request->existing_content_file[$key]);
                }

                // Store the new file
                $path = Storage::disk('cms')->put('', $request->file('content_file.' . $key));
                $frontend_content->update(['content_file' => $path]);
            } else {
                // Keep the existing file if no new file is uploaded
                $frontend_content->update(['content_file' => $request->existing_content_file[$key]]);
            }
        }

        return redirect()->route('backend.frontend-contents')->with('success', 'Frontend content updated successfully');
    }
    public function status(Request $request)
    {

        $color = FrontendPage::find($request->id);

        $color->update([
            'status' => $request->status
        ]);

        return response()->json(200);
    }


    public function destroy(Request $request)
    {

        $color = FrontendPage::find($request->id);

        $color->delete();
        return response()->json(200);
    }
}
