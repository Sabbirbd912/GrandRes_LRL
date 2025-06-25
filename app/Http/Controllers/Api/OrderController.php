<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order=Order::all();
        return response()->json($order);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order=new Order();
        $order->customer_id=$request->customer_id;
        $order->order_date=date("Y-m-d");
        $order->delivery_date=date("Y-m-d");
        $order->shipping_address=$request->shipping_address;
        $order->order_total=$request->order_total;
        $order->paid_amount=$request->paid_amount;
        $order->remark=$request->remark;
        $order->status_id=$request->status_id;
        $order->discount=$request->discount;
        $order->vat=$request->vat;
        $order->table_id=$request->table_id;
        $order->save();

        $items = $request->items;
        foreach($items as $item){
            $details=new OrderDetail();
            $details->order_id=$order->id;
            $details->product_id=$item["product_id"];
            $details->qty=$item["qty"];
            $details->price=$item["price"];
            $details->vat=$item["vat"];
            $details->discount=$item["discount"];
            $details->save();
        }
        return response()->json(['success'=>'Saved']);
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
