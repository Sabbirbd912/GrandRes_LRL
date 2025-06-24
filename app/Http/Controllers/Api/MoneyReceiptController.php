<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MoneyReceipt;
use App\Models\MoneyReceiptDetail;

class MoneyReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $money_receipt = ["money_receipts"=>MoneyReceipt::all()];
        return response()->json($money_receipt);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $money_receipt= new MoneyReceipt();
        $money_receipt->customer_id=$request->customer_id;
        $money_receipt->remark=$request->remark;
        $money_receipt->receipt_total=$request->receipt_total;
        $money_receipt->discount=$request->discount;
        $money_receipt->vat=$request->vat;
        $money_receipt->save();

        $items = $request->items;
        foreach($items as $item){
            $details=new MoneyReceiptDetail();
            $details->money_receipt_id=$money_receipt->id;
            $details->product_id=$item["product_id"];
            $details->price=$item["price"];
            $details->qty=$item["qty"];
            $details->vat=$item["vat"];
            $details->discount=$item["discount"];
            $details->save();
        }
        return response()->json(['success' => 'Saved']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
