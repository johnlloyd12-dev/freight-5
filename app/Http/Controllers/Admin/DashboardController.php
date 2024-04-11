<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\fms_g11_fuel;
use App\Models\fms_g15_expenses;
use App\Models\fms_g15_invoices;
use App\Models\fms_g16_orders;
use App\Models\fms_g18_formdetails;

class DashboardController extends Controller
{
    public function index()
    {
   
        $formdetails = fms_g15_invoices::all();
        $data = fms_g15_invoices::count();
        $data2 = fms_g11_fuel::sum('v_fuelprice');       
        return view('admin.dashboard', compact('formdetails','data','data2'));
    }
    public function Manage()
{
    return dd(ok);
    // $invoice = Invoices::all();
    // return view('admin.invoices.manage')->with('invoice',$invoice);
}
}
