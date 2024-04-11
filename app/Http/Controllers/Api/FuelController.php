<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fms_g11_fuel;

class FuelController extends Controller
{
    public function fuel()
    {
        $fuel = fms_g11_fuel::all();

        if ($fuel->isEmpty()) {
            // If no users are found, return a custom response
            $data = [
                'status' => 404,
                'message' => 'No fuel found',
            ];
        } else {
            // If users are found, return them in the response
            $data = [
                'status' => 200,
                'fuel' => $fuel
            ];
        }
        
        // Return JSON response
        return response()->json($data);        
    }
    
    public function fuelFind($id)
    {
        $fuel = fms_g11_fuel::find($id);
    
        if (!$fuel) {
            // If no fuel record is found with the provided ID, return a custom response
            $data = [
                'status' => 404,
                'message' => 'Fuel not found',
            ];
        } else {
            // If a fuel record is found, return its data in the response
            $data = [
                'status' => 200,
                'fuel' => $fuel
            ];
        }
        
        // Return JSON response
        return response()->json($data);
    }
}    
