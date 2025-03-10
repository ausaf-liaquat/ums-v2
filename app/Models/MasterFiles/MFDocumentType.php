<?php

namespace App\Models\MasterFiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MFDocumentType extends Model
{
    use HasFactory;

    protected $table = "document_types";

    protected $fillable =['name', 'status'];
}
