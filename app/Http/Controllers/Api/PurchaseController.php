<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Stock;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases=Purchase::all();
        return response()->json(["purchases"=>$purchases]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchase=new Purchase();
        $purchase->supplier_id=$request->supplier_id;
        $purchase->purchase_date=date("Y-m-d");
        $purchase->delivery_date=date("Y-m-d");
        $purchase->shipping_address="N/A";
        $purchase->purchase_total=$request->purchase_total;
        $purchase->paid_amount=$request->paid_amount;
        $purchase->remark="N/A";
        $purchase->status_id=1;
        $purchase->discount=0;
        $purchase->vat=0;
        $purchase->save();

        $items=$request->items;

        foreach($items as $item){
            $details=new PurchaseDetail();
            $details->purchase_id=$purchase->id;
            $details->raw_material_id=$item["raw_material_id"];
            $details->qty=$item["qty"];
            $details->price=$item["price"];
            $details->vat=$item["vat"];
            $details->discount=$item["discount"];
            $details->save();

            $stock=new Stock();
            $stock->raw_material_id=$item["raw_material_id"];
            $stock->transaction_type_id=1;
            $stock->qty=$item["qty"];       
            $stock->remark="Purchase";  
            //$stock->timestamps = false;
            $stock->save();
        }
        $data=[   
            "id"=>$purchase->id,          
            "msg"=>"Success"
        ];

         return response()->json($data);
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
