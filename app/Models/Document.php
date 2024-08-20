<?php

namespace App\Models;

use App\Models\MasterFiles\MFDocumentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

    protected $table = "documents";

    protected $guarded = ['id', 'created_at', 'updated_at'];


    /**
     * @var array
     */
    protected $appends = ['document_url'];

    /**
     * @return mixed
     */
    public function getDocumentUrlAttribute()
    {
        // Storage::disk('cms')->exists($this->file ?? '')
        $media =$this->file;
        if (!empty($media)) {
            return  Storage::disk('cms')->url($media);
        }

        return '';
    }

     /**
     * Get the type that owns the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentType(): BelongsTo
    {
        return $this->belongsTo(MFDocumentType::class, 'document_type_id');
    }
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

    public function prepareDocument(): array
    {
        return [
            'id'               => $this->id,
            'title'            => $this->title ?? 'N/A',
            'document_type_id' => $this->document_type_id ?? 'N/A',
            'patient_id'       => $this->patient_id ?? 'N/A',
            'uploaded_by'      => $this->uploaded_by ?? 'N/A',
            'notes'            => $this->notes ?? 'N/A',
            'is_default'       => $this->is_default ?? 'N/A',
            'document_url'     => $this->document_url ?? 'N/A',
        ];
    }
}
