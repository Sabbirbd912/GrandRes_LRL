<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\MoneyReceiptController;
use App\Http\Controllers\Api\AutoReservationController;
use App\Http\Controllers\Api\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Order find funciton
Route::get('customers/find/{id}', [CustomerController::class, 'find']);

Route::apiResources([
    'customers' => CustomerController::class,
    'orders' => OrderController::class,
    'money_receipts' => MoneyReceiptController::class,
    'purchases' => PurchaseController::class,
    'products' => ProductController::class,
]);

Route::post('/auto-reserve', [AutoReservationController::class, 'reserve']);
