<?php

namespace App\Models\MasterFiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MFColor extends Model
{
    use HasFactory;

    protected $table = "mf_colors";

    protected $fillable =['name','color', 'status'];
}
