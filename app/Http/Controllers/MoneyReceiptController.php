<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\Company;

class MoneyReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moneyreceipt=DB::table("money_receipts")->get();
        return view("pages.money_receipt.index",["money_receipts"=>$moneyreceipt]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $Order_last = Order::max('id');
        $customers = Customer::all();
        $products = Product::all();
        $company = Company::find(1);
        return view("money_receipt.create", compact(
            'Order_last',
            'customers',
            'products',
            'company'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $money_receipt=new MoneyReceipt();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
