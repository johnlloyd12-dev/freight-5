<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\Admin\InvoiceController;



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
    Route::get('/invoices/view', [App\Http\Controllers\Admin\InvoiceController::class, 'vieworder'])->name('vieworder');
    Route::get('/generatePdf/generate-pdf/{id}', [InvoiceController::class, 'generatePdf'])->name('generate.pdf');

    Route::get('/invoices/{id}', [App\Http\Controllers\Admin\InvoiceController::class, 'invoiceview'])->name('invoice.view');
    Route::get('/manage', [App\Http\Controllers\Admin\InvoiceController::class, 'manage']);

    ///get data in api database stripe
      
    Route::get('/paymentshistory', [App\Http\Controllers\Admin\InvoiceController::class, 'payments'])->name('payments');

    Route::get('/payment', [App\Http\Controllers\Admin\InvoiceController::class, 'payment']);

    ///INV
    Route::post('/stripe', [InvoiceController::class, 'stripe'])->name('stripe');
    Route::get('/success', [InvoiceController::class, 'success'])->name('success');
    Route::get('/cancel', [InvoiceController::class, 'cancel'])->name('cancel');
    

    //income;expenses routes
    Route::get('/expenses', [App\Http\Controllers\Admin\ExpenseController::class, 'view']);



});