<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\Customer;
use App\Models\Product;
use App\Models\MoneyReceipt;
use App\Models\MoneyReceiptDetail;
use App\Models\Company;

class MoneyReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $moneyreceipt=DB::table("money_receipts")->get();
        // return view("pages.money_receipt.index",["money_receipts"=>$moneyreceipt]);
        $money_receipts = MoneyReceipt::with('customer')->get();
        return view('pages.money_receipt.index', compact('money_receipts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $Receipt_last = MoneyReceipt::max('id');
        $customers = Customer::all();
        $products = Product::all();
        $company = Company::find(1);
        return view("pages.money_receipt.create", compact(
            'Receipt_last',
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
    public function show($id)
    {
        $money_receipt = MoneyReceipt::with('customer')->findOrFail($id);
        $details = MoneyReceiptDetail::where('money_receipt_id', $id)->get();
        $company = Company::find(1);

        return view('pages.money_receipt.show', compact('money_receipt', 'details', 'company'));
    }


    // public function show($id){
    //     $moneyreceipt = MoneyReceipt::with('customer')->find($id);
    //     $company = Company::find(1);
    //     return view("pages.money_receipt.show", compact('moneyreceipt', 'company'));

    // }
    
    // {
    //     $moneyreceipt = MoneyReceipt::find($id);

    //     if (!$moneyreceipt) {
    //         return redirect()->route('money_receipt.index')->with('error', 'Money Receipt not found.');
    //     }

    //     return view("pages.money_receipt.show", ["money_receipt" => $moneyreceipt]);
    // }
    // public function show($id)
    // {
    //     $moneyreceipt=MoneyReceipt::find($id);
    //     return view("pages.money_receipt.show", ["money_receipt"=>$moneyreceipt]);
    // }

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
