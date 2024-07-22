<?php

namespace App\Models\FrontendContents;

use App\Models\MasterFiles\MFContentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FrontendContent extends Model
{
    use HasFactory;

    protected $table = "frontend_contents";

    protected $fillable = ['frontend_page_id','mf_content_type_id','content_title','content_file','content_text'];

     /**
     * Get the content_type that owns the Frontend Content
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content_type(): BelongsTo
    {
        return $this->belongsTo(MFContentType::class, 'mf_content_type_id');
    }
}
