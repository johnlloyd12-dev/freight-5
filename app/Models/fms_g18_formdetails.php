<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fms_g18_formdetails extends Model
{
    protected $table = 'fms_g18_formdetails';

    use HasFactory;

    protected $connection = "orderdb";
}
