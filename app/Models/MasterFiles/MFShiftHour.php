<?php

namespace App\Models\MasterFiles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MFShiftHour extends Model
{
    use HasFactory;

    protected $table = "mf_shift_hours";

    protected $fillable =['name','start_time','end_time','shift_total_hours', 'status'];
}
