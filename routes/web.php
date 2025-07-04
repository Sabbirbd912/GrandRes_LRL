<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Sales\SalesInvoiceController;
use App\Http\Controllers\MoneyReceiptController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\StockController;

// -------------------------
// Default Home Route
// -------------------------
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// -------------------------
// Product Routes
// -------------------------
Route::get('/products/{id}/confirm', [ProductController::class, 'confirm'])->name('products.confirm');
Route::resource('products', ProductController::class);

// -------------------------
// Table Routes
// -------------------------
Route::get('tables/manage', [TableController::class, 'manage'])->name('tables.manage');
Route::get('tables/{id}/book', [TableController::class, 'book'])->name('tables.book');
Route::get('/tables/{id}/confirm', [TableController::class, 'confirm'])->name('tables.confirm');
Route::resource('tables', TableController::class);

// -------------------------
// Customer Routes
// -------------------------
Route::get('/customers/{id}/delete', [CustomerController::class, 'delete'])->name('customers.delete');
Route::resource('customers', CustomerController::class);

// -------------------------
// Order Routes
// -------------------------
Route::get('/orders/{id}/delete', [OrderController::class, 'delete'])->name('orders.delete');
Route::resource('orders', OrderController::class);

// -------------------------
// Reservation Routes
// -------------------------
Route::post('/auto-reserve', [ReservationController::class, 'autoReserveAndConfirm'])->name('reservations.auto');
Route::get('/reservations/{id}/delete', [ReservationController::class, 'delete'])->name('reservations.delete');
Route::get('/reservations/{id}/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
Route::get('/reservations/{id}/checkout', [ReservationController::class, 'checkout'])->name('reservations.checkout');
Route::resource('reservations', ReservationController::class);

// -------------------------
// Purchase Routes
// -------------------------
Route::get('/purchases/{id}/delete', [PurchaseController::class, 'delete'])->name('purchases.delete');
Route::resource('purchases', PurchaseController::class);

// -------------------------
// Supplier Routes
// -------------------------
Route::get('/suppliers/{id}/delete', [SupplierController::class, 'delete'])->name('suppliers.delete');
Route::resource('suppliers', SupplierController::class);

// -------------------------
// Sales Invoice Routes
// -------------------------
Route::get('/sales/invoices', [SalesInvoiceController::class, 'index'])->name('sales.invoices');

// -------------------------
// Money Receipt Routes
// -------------------------
Route::resource('money_receipts', MoneyReceiptController::class);

// -------------------------
// Raw Material Routes
// -------------------------
Route::resource('raw_materials', RawMaterialController::class);

// -------------------------
// Stock Routes
// -------------------------
// Route::get('stocks/balance', [StockController::class, 'balance'])->name('stocks.balance');
// Route::resource('stocks', StockController::class);


Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
Route::get('/stocks/balance', [StockController::class, 'balance'])->name('stocks.balance');
// -------------------------
// Database Connection Check
// -------------------------
Route::get('/db-check', function () {
    try {
        \DB::connection()->getPdo();
        return "✅ Database connected: " . \DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "❌ Could not connect: " . $e->getMessage();
    }
});
