<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fms_g15_invoices extends Model
{
    use HasFactory;

    protected $table = 'fms_g15_invoices';
    
    protected $fillable = [
        'id',
        'invoice_number',
        'payment_method',
        'customer_name',
        'company_name',
        'carrier',
        'status',
        'created_at',
        'updated_at',
    ];
}
