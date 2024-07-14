<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function productNameValidator(Request $request)
    {
        $product_name = $request->product_name;

        $exists = Product::where('title', $product_name)->exists();

        return response()->json(['is_unique' => !$exists]);
    }
}
