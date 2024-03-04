<?php

namespace App\Http\Controllers\Admin;

use App\Models\fms_g15_expenses;
use Illuminate\Http\Request;
use App\Models\fms_g18_formdetails;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $formdetails = fms_g18_formdetails::all();
        return view('admin.dashboard', compact('formdetails'));
    }
    public function Manage()
{
    return dd(ok);
    // $invoice = Invoices::all();
    // return view('admin.invoices.manage')->with('invoice',$invoice);
}
}
