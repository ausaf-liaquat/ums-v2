<?php

namespace App\Http\Controllers\Backend\Products;

use App\Http\Controllers\Controller;
use App\Models\MasterFiles\MFColor;
use App\Models\MasterFiles\MFSize;
use App\Models\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('backend.products.index');
    }

    public function dataTable(Request $request)
    {

        $model = Product::with('type');

        return DataTables::eloquent($model)->addIndexColumn()->make(true);
    }


    public function create(Request $request)
    {

        $data = [
            'isEdit' => false,
            'colors' => MFColor::whereStatus(1)->get(),
            'sizes'  => MFSize::whereStatus(1)->get(),
            'types'  => DB::table('mf_types')->get(),
        ];

        return view('backend.products.add', $data);
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'title' => 'required|unique:products,title',
        ]);

        $product = Product::create([
            'title'       => $request->title,
            'slug'        => $request->slug,
            'description' => $request->description,
            'price'       => $request->price,
            'mf_type_id'  => $request->mf_type_id
        ]);

        $product->colors()->sync($request->color);
        $product->sizes()->sync($request->size);

        $files = [];

        // Check if the request has files
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = Storage::disk('cms')->put('', $image);
                $files[] = $path; // Collect file paths
            }
        }

        $product->update(['image' => json_encode($files)]);
        // $file = Storage::disk('cms')->put('', file_get_contents($request->images));

        return redirect()->route('backend.products')->with('success', 'Product added successfully');
    }

    public function edit(Product $product)
    {

        $data = [
            'isEdit'  => true,
            'product' => $product,
            'colors'  => MFColor::whereStatus(1)->get(),
            'sizes'   => MFSize::whereStatus(1)->get(),
            'types'   => DB::table('mf_types')->get(),
        ];

        return view('backend.products.add', $data);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => "required|unique:products,title,$product->id",
        ]);

        $product->update([
            'title'       => $request->title,
            'slug'        => $request->slug,
            'description' => $request->description,
            'price'       => $request->price,
            'mf_type_id'  => $request->mf_type_id
        ]);

        $product->colors()->sync($request->color);
        $product->sizes()->sync($request->size);

        // Delete previously saved images
        if ($product->image) {
            $existingImages = json_decode($product->image);
            foreach ($existingImages ?? [] as $image) {
                Storage::disk('cms')->delete($image);
            }
        }

        $files = [];

        // Check if the request has files
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = Storage::disk('cms')->put('', $image);
                $files[] = $path; // Collect file paths
            }
        }

        $product->update(['image' => json_encode($files)]);

        return redirect()->route('backend.products')->with('success', 'Product updated successfully');
    }
    public function status(Request $request)
    {

        $product = Product::find($request->id);

        $product->update([
            'status' => $request->status
        ]);

        return response()->json(200);
    }


    public function destroy(Request $request)
    {

        $product = Product::find($request->id);

        $product->delete();
        return response()->json(200);
    }
}
