<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class W9Form extends Model
{
    use HasFactory;

    protected $table = "w_nine_form";

    protected $guarded  = ['id'];
}
