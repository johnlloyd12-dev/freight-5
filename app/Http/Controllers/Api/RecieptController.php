<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fms_g18_formdetails;

class RecieptController extends Controller
{
    public function test()
    {
        $reciept = fms_g18_formdetails::all();

        if ($reciept->isEmpty()) {
            // If no users are found, return a custom response
            $data = [
                'status' => 404,
                'message' => 'No reciept found',
            ];
        } else {
            // If users are found, return them in the response
            $data = [
                'status' => 200,
                'reciept' => $reciept
            ];
        }
        
        // Return JSON response
        return response()->json($data);        
    }
    
    public function recieptFind($id)
    {
        $recieptFind = fms_g18_formdetails::find($id);
    
        if (!$recieptFind) {
            // If no fuel record is found with the provided ID, return a custom response
            $data = [
                'status' => 404,
                'message' => 'reciept not found',
            ];
        } else {
            // If a fuel record is found, return its data in the response
            $data = [
                'status' => 200,
                'recieptFind' => $recieptFind
            ];
        }
        
        // Return JSON response
        return response()->json($data);
    }
}
