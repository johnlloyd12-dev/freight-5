<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fms_g15_expenses extends Model
{
    use HasFactory;
    protected $fillable = ['drivers_name', 'amount'];
}
