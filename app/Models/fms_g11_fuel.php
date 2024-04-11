<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fms_g11_fuel extends Model
{
    use HasFactory;
    protected $table = 'fms_g11_fuel';

    protected $fillable = [
        'v_fuel_id ',
        'v_id',
        'v_fuel_quantity',
        'v_odometerreading',
        'v_fuelprice',
        'v_fuelfilldate', // Include the status field here
        'v_fueladdedby',
        'v_fuelcomments',
    ];

    protected $primaryKey = 'v_fuel_id';
}
