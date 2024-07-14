<?php

namespace App\Models\MasterFiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MFSize extends Model
{
    use HasFactory;

    protected $table = 'mf_sizes';

    protected $fillable =['name', 'status'];
}
