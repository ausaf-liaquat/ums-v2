<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositForm extends Model
{
    use HasFactory;

    protected $table = "deposit";


    protected $guarded  = ['id'];
    
}