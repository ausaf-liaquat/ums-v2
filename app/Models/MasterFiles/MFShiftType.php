<?php

namespace App\Models\MasterFiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MFShiftType extends Model
{
    use HasFactory;

    protected $table = "mf_shift_types";

    protected $fillable =['name', 'status'];
}
