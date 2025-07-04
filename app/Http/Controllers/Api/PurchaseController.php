<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::all();
        return response()->json(["purchases" => $purchases]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Insert into purchases table
            $purchase = new Purchase();
            $purchase->supplier_id     = $request->supplier_id;
            $purchase->purchase_date   = $request->purchase_date ?? now();
            $purchase->delivery_date   = $request->delivery_date ?? now();
            $purchase->shipping_address = $request->shipping_address ?? '';
            $purchase->purchase_total  = $request->purchase_total ?? 0;
            $purchase->paid_amount     = $request->paid_amount ?? 0;
            $purchase->remark          = $request->remark ?? '';
            $purchase->status_id       = $request->status_id ?? 1;
            $purchase->discount        = $request->discount ?? 0;
            $purchase->vat             = $request->vat ?? 0;
            $purchase->save();

            // Insert purchase details
            if (is_array($request->items)) {
                foreach ($request->items as $item) {
                    if (!isset($item['raw_material_id'])) continue;

                    $detail = new PurchaseDetail();
                    $detail->purchase_id     = $purchase->id;
                    $detail->raw_material_id = $item['raw_material_id'];
                    $detail->qty             = $item['qty'] ?? 1;
                    $detail->price           = $item['price'] ?? 0;
                    $detail->vat             = $item['vat'] ?? 0;
                    $detail->discount        = $item['discount'] ?? 0;
                    $detail->created_at      = now();
                    $detail->updated_at      = now();
                    $detail->save();
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Purchase saved successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Purchase error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Server error occurred.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id) { /* optional */ }

    public function update(Request $request, string $id) { /* optional */ }

    public function destroy(string $id) { /* optional */ }
}
