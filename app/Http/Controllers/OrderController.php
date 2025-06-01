<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Libraries\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $orders=DB::table("orders")->get();
        $orders = Order::with('customer')->get();
        return view("pages.order.index",["orders"=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order=new Order();
        $order->customer_id=$request->customer_id;
        $order->order_date=$request->order_date;
        $order->delivery_date=$request->delivery_date;
        $order->shipping_address=$request->shipping_address;
        $order->order_total=$request->order_total;
        $order->paid_amount=$request->paid_amount;
        $order->remark=$request->remark;
        $order->status_id=$request->status_id;
        $order->discount=$request->discount;
        $order->vat=$request->vat;
        $order->save();
        return redirect("orders");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order=Order::find($id);
        return view("pages.order.show", ["order"=>$order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order=Order::find($id);
        return view("pages.order.edit",["order"=>$order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->customer_id=$request->customer_id;
        $order->order_date=$request->order_date;
        $order->delivery_date=$request->delivery_date;
        $order->shipping_address=$request->shipping_address;
        $order->order_total=$request->order_total;
        $order->paid_amount=$request->paid_amount;
        $order->remark=$request->remark;
        $order->status_id=$request->status_id;
        $order->discount=$request->discount;
        $order->vat=$request->vat;
        $order->update();

        return redirect("orders");
    }

    /**
     * Remove the specified (optional) resource from storage.
     */
    public function delete($id)
    {
        $order=Order::find($id);
        return view("pages.order.delete",["order"=>$order]);
    }

        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect("orders");
    }

}
