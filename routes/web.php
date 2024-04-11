<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Mail\InvoiceMail;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //invoice routes
    Route::get('/invoices', [App\Http\Controllers\Admin\InvoiceController::class, 'index']);
    Route::get('/invoices/view', [InvoiceController::class, 'vieworder'])->name('vieworder');
    Route::get('/invoicesGenerate/{id}', [InvoiceController::class, 'generatePdf'])->name('generate.pdf');
    Route::get('downloadpdf/{id}', [InvoiceController::class, 'downloadpdf'])->name('download.pdf');
    // Route::get('/generate-pdf/{id}', [InvoiceController::class, 'generatePdf'])->name('mailInvoice');
    // Route::get('/generate-pdf/{id}', function($id){
    //     $formdetails = fms_g18_formdetails::findOrFail($id);
    //     $name = $formdetails->name; // Assuming name is a field in your form details
    
    //     // Retrieve the file path from the database or use the stored file name
    //     $fileName = $formdetails->pdf_file;
    //     $filePath = storage_path("app/public/{$fileName}");
    
    //     Mail::to('stephenthompson5656@gmail.com')->send(new InvoiceMail($name, $filePath));
    // })->name('mailInvoice');



    Route::get('/invoices/{id}', [InvoiceController::class, 'invoiceview'])->name('invoice.view');
    Route::get('/manage', [App\Http\Controllers\Admin\InvoiceController::class, 'manage']);
    Route::get('/claims', [App\Http\Controllers\Admin\ExpenseController::class, 'claims']);
    Route::get('/warehouse', [App\Http\Controllers\Admin\ExpenseController::class, 'warehouse']);

    ///get data in api database stripe
      
    Route::get('/paymentshistory', [App\Http\Controllers\Admin\InvoiceController::class, 'payments'])->name('payments');

    Route::get('/payment', [App\Http\Controllers\Admin\InvoiceController::class, 'payment']);

    ///INV
    Route::post('/stripe', [InvoiceController::class, 'stripe'])->name('stripe');
    Route::get('/success', [InvoiceController::class, 'success'])->name('success');
    Route::get('/cancel', [InvoiceController::class, 'cancel'])->name('cancel');
    

    //income;expenses routes
    Route::get('/expenses', [ExpenseController::class, 'view']);



});