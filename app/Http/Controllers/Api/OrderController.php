<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fms_g18_formdetails;

class OrderController extends Controller
{
    public function order()
    {
        $order = fms_g18_formdetails::all();

        if ($order->isEmpty()) {
            // If no users are found, return a custom response
            $data = [
                'status' => 404,
                'message' => 'No order found',
            ];
        } else {
            // If users are found, return them in the response
            $data = [
                'status' => 200,
                'order' => $order
            ];
        }
        
        // Return JSON response
        return response()->json($data);        
    }
    
    public function orderFind($id)
    {
        $orderFind = fms_g18_formdetails::find($id);
    
        if (!$orderFind) {
            // If no fuel record is found with the provided ID, return a custom response
            $data = [
                'status' => 404,
                'message' => 'orderFind not found',
            ];
        } else {
            // If a fuel record is found, return its data in the response
            $data = [
                'status' => 200,
                'orderFind' => $orderFind
            ];
        }
        
        // Return JSON response
        return response()->json($data);
    }
}
