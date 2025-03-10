<?php

namespace App\Models\MasterFiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MFQualificationType extends Model
{
    use HasFactory;

    protected $table = "mf_qualification_types";

    protected $fillable =['name', 'status'];
}
