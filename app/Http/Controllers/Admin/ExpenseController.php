<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\fms_g11_fuel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ExpenseController extends Controller
{
    public function expense()
    {
        return view('admin.expenses.expense');
    }
    public function view()
    {
        $data = fms_g11_fuel::latest()->paginate(5);

        $row = fms_g11_fuel::all();
        return view('admin.expenses.expense', compact('data','row'));
    }
    
        public function claims()
        {
            return view('admin.claims.claims');
        }
        public function warehouse()
        {
            return view('admin.warehouse.warehouse');
        }
       
    
       
    
   
}
