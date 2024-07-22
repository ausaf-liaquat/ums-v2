<?php

namespace App\Models\FrontendContents;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FrontendPage extends Model
{
    use HasFactory;

    protected $table="frontend_pages";

    protected $fillable = ['name','description','status'];

    /**
     * Get all of the contents for the Frontend Page
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents(): HasMany
    {
        return $this->hasMany(FrontendContent::class, 'frontend_page_id');
    }
}
