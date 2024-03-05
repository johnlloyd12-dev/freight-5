<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\fms_g15_expenses;
use App\Models\fms_g18_formdetails;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
   
        $formdetails = fms_g18_formdetails::all();
        $data = fms_g18_formdetails::count();
        $data2 = fms_g15_expenses::sum('amount');       
        return view('admin.dashboard', compact('formdetails','data','data2'));
    }
    public function Manage()
{
    return dd(ok);
    // $invoice = Invoices::all();
    // return view('admin.invoices.manage')->with('invoice',$invoice);
}
}
