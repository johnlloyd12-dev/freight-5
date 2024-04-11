<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Api\FuelController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RecieptController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('stripe',[InvoiceController::class], 'stripe');

Route::get('fuel',[FuelController::class,'fuel']);

Route::get('fuel/{id}',[FuelController::class, 'fuelFind']);

Route::get('order',[OrderController::class,'order']);

Route::get('order/{id}',[OrderController::class, 'orderFind']);

Route::get('receipt',[RecieptController::class,'test']);

Route::get('receipt/{id}',[RecieptController::class, 'recieptFind']);