<?php

namespace App\Models\MasterFiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MFContentType extends Model
{
    use HasFactory;

    protected $table = "mf_content_types";

    protected $fillable =['name', 'status'];
}
