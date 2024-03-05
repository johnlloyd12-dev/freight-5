<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\fms_g15_expenses;
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
        $data = fms_g15_expenses::latest()->paginate(5);

        $user = fms_g15_expenses::query('*')->get()->first();
        return view('admin.expenses.expense', compact('data', 'user'));
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
