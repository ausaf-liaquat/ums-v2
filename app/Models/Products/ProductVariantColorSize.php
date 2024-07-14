<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantColorSize extends Model
{
    use HasFactory;

    protected $table = "product_variant_color_sizes";

    protected $fillable = ['product_variant_id', 'mf_color_id',	'size_id',	'quantity',	'images'];

}
