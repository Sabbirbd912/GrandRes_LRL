<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\MoneyReceiptController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResources([
    'orders' => OrderController::class,
    'money_receipts' => MoneyReceiptController::class,
    'purchases' => PurchaseController::class,
]);