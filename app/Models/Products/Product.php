<?php

namespace App\Models\Products;

use App\Models\MasterFiles\MFColor;
use App\Models\MasterFiles\MFSize;
use App\Models\MasterFiles\MFType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = ['mf_type_id',    'title',    'slug',    'description',    'image',    'price',    'quantity', 'status'];

    /**
     * The colors that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(MFColor::class, 'product_colors', 'product_id', 'color_id');
    }

    /**
     * The sizes that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(MFSize::class, 'product_sizes', 'product_id', 'size_id');
    }

    /**
     * Get the type that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(MFType::class, 'mf_type_id');
    }
}
