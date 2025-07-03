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
        try {
            $purchase = new Purchase();
            $purchase->supplier_id = $request->supplier_id ?? null;
            $purchase->payment_term = $request->payment_term ?? 'CASH';
            $purchase->purchase_total = $request->purchase_total ?? 0;
            $purchase->paid_amount = $request->paid_amount ?? 0;
            $purchase->remark = $request->remark ?? '';
            $purchase->save();

            // Optional: save purchase details
            if (is_array($request->items ?? null)) {
                foreach ($request->items as $item) {
                    if (!isset($item['product_id'])) continue;

                    $detail = new PurchaseDetail();
                    $detail->purchase_id = $purchase->id;
                    $detail->product_id = $item['product_id'];
                    $detail->qty = $item['qty'] ?? 1;
                    $detail->price = $item['price'] ?? 0;
                    $detail->save();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Purchase saved successfully.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Purchase error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Server error occurred.',
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
