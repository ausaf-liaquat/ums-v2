<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpBcaForm extends Model
{
    use HasFactory;

    protected $table = "emp_bca_form";


    protected $guarded  = ['id'];
}
