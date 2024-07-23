<?php

namespace App\Models;

use App\Models\MasterFiles\MFDocumentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $table = "documents";

    protected $guarded = ['id', 'created_at', 'updated_at'];

     /**
     * Get the type that owns the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function document_type(): BelongsTo
    {
        return $this->belongsTo(MFDocumentType::class, 'document_type_id');
    }

     /**
     * Get the type that owns the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uploaded_clinician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
