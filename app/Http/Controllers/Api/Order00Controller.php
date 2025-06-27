<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Reservation;
use App\Models\Table;

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
        // 🧾 1. Save the Order
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->order_date = date("Y-m-d");
        $order->delivery_date = date("Y-m-d");
        $order->shipping_address = $request->shipping_address;
        $order->order_total = $request->order_total;
        $order->paid_amount = $request->paid_amount;
        $order->remark = $request->remark;
        $order->status_id = $request->status_id;
        $order->discount = $request->discount;
        $order->vat = $request->vat;
        $order->table_id = $request->table_id;
        $order->save();

        // 🧾 2. Save Order Details
        $items = $request->items;
        foreach ($items as $item) {
            $details = new OrderDetail();
            $details->order_id = $order->id;
            $details->product_id = $item["product_id"];
            $details->qty = $item["qty"];
            $details->price = $item["price"];
            $details->vat = $item["vat"];
            $details->discount = $item["discount"];
            $details->total = $item["lineTotal"] ?? ($item["qty"] * $item["price"]);
            $details->save();
        }

        // 🧾 3. Auto Reservation Confirmed
        Reservation::create([
            'customer_id'       => $request->customer_id,
            'table_id'          => $request->table_id,
            'reservation_date'  => date("Y-m-d"),
            'reservation_time'  => date("H:i"),
            'status'            => 1, // 1 = Confirmed
        ]);

        // 🧾 4. Update Table Status to Booked
        $table = Table::find($request->table_id);
        if ($table) {
            $table->status = 1; // 1 = Booked
            $table->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Order, OrderDetails, and Reservation created successfully.'
        ]);
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
