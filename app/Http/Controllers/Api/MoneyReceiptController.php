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
        try {
            // ✅ Step 1: Create main receipt (safe defaults)
            $money_receipt = new MoneyReceipt();
            $money_receipt->customer_id = $request->customer_id ?? null;
            $money_receipt->remark = $request->remark ?? '';
            $money_receipt->receipt_total = $request->receipt_total ?? 0;
            $money_receipt->discount = $request->discount ?? 0;
            $money_receipt->vat = $request->vat ?? 0;
            $money_receipt->save();

            // ✅ Step 2: Save items if they exist
            $items = $request->items ?? [];

            if (is_array($items)) {
                foreach ($items as $item) {
                    if (!isset($item['product_id'])) continue;

                    $details = new MoneyReceiptDetail();
                    $details->money_receipt_id = $money_receipt->id;
                    $details->product_id = $item['product_id'];
                    $details->price = $item['price'] ?? 0;
                    $details->qty = $item['qty'] ?? 1;
                    $details->vat = $item['vat'] ?? 0;
                    $details->discount = $item['discount'] ?? 0;
                    $details->save();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Money receipt saved (without validation).'
            ]);
        } catch (\Exception $e) {
            \Log::error('Money receipt error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500);
        }
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
