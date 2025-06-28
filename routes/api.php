<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\MoneyReceiptController;

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
]);

Route::post('/auto-reserve', function(Request $request){
    $reservation = new \App\Models\Reservation();
    $reservation->customer_id = $request->customer_id;
    $reservation->table_id = $request->table_id;
    $reservation->reservation_date = date("Y-m-d");
    $reservation->reservation_time = date("H:i:s");
    $reservation->status = 1; // Confirmed
    $reservation->save();

    // Table Book
    $table = \App\Models\Table::find($request->table_id);
    if ($table) {
        $table->status = 1;
        $table->save();
    }

    return response()->json(['success' => true, 'message' => 'Reserved']);
});
