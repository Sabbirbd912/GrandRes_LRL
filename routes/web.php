<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Sales\SalesInvoiceController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;


//default route
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('pages.home');
});


//CRUD route
Route::resource('products', ProductController::class);
Route::get('/products/{id}/confirm',[ProductController::class,'confirm']);

Route::resource('tables', TableController::class);
Route::get('/tables/{id}/confirm',[TableController::class,'confirm']);

Route::resource('customers', CustomerController::class);
Route::get('/customers/{id}/delete',[CustomerController::class,'delete']);

Route::resource('orders', OrderController::class);
Route::get('/orders/{id}/delete',[OrderController::class,'delete']);

Route::resource('reservations', ReservationController::class);
Route::get('/reservations/{id}/delete',[ReservationController::class,'delete']);
Route::get('reservations/{id}/confirm', [ReservationController::class, 'confirm']);
Route::post('reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
Route::get('reservations/{id}/checkout', [ReservationController::class, 'checkout']);



Route::resource('purchases', PurchaseController::class);
Route::get('/purchases/{id}/delete',[PurchaseController::class,'delete']);

Route::resource('suppliers', SupplierController::class);
Route::get('/suppliers/{id}/delete',[SupplierController::class,'delete']);

//Invoice Route
Route::get("/sales/invoices",[SalesInvoiceController::class,'index']);


// Route::get('/pages.home',[HomeController::class,'index']);

// Optional: Quick DB connection check
Route::get('/db-check', function () {
    try {
        \DB::connection()->getPdo();
        return "✅ Database connected: " . \DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "❌ Could not connect: " . $e->getMessage();
    }
});
