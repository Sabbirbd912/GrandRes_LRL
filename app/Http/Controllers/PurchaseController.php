<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Libraries\Core\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases=DB::table("purchases") ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')->select('purchases.*', 'suppliers.name as supplier_name')->paginate(10);
        return view("pages.purchase.index",["purchases"=>$purchases]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all(); // সকল supplier আনুন
        //return view("pages.purchase.create");
        return view("pages.purchase.create", ["suppliers" => $suppliers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchase=new Purchase();
        $purchase->supplier_id=$request->supplier_id;
        $purchase->purchase_date=$request->purchase_date;
        $purchase->delivery_date=$request->delivery_date;
        $purchase->shipping_address=$request->shipping_address;
        $purchase->purchase_total=$request->purchase_total;
        $purchase->paid_amount=$request->paid_amount;
        $purchase->remark=$request->remark;
        $purchase->status_id=$request->status_id;
        $purchase->discount=$request->discount;
        $purchase->vat=$request->vat;
        $purchase->save();

        return redirect("purchases");
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        // $purchase=Purchase::find($id);
        $purchase=Purchase::with('supplier')->findOrFail($purchase->id);
        return view("pages.purchase.show",["purchase"=>$purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $purchase=Purchase::find($id);
        return view("pages.purchase.edit",["purchase"=>$purchase]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        $purchase->supplier_id=$request->supplier_id;
        $purchase->purchase_date=$request->purchase_date;
        $purchase->delivery_date=$request->delivery_date;
        $purchase->shipping_address=$request->shipping_address;
        $purchase->purchase_total=$request->purchase_total;
        $purchase->paid_amount=$request->paid_amount;
        $purchase->remark=$request->remark;
        $purchase->status_id=$request->status_id;
        $purchase->discount=$request->discount;
        $purchase->vat=$request->vat;
        $purchase->update();

        return redirect("purchases");
    }

    /**
     * Remove the specified (Optional) resource from storage.
     */
    public function delete($id)
    {
        $purchase=Purchase::find($id);
        return view("pages.purchase.delete",["purchase"=>$purchase]);
    }
        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect("purchases");
    }

}
