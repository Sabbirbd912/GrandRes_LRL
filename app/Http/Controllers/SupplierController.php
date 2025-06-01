<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Libraries\Core\File;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers=DB::table("suppliers")->get();
        return view("pages.supplier.index",["suppliers"=>$suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.supplier.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $supplier=new Supplier();
        $supplier->name=$request->name;
        $supplier->mobile=$request->mobile;
        $supplier->email=$request->email;
        $supplier->save();
        
            if($request->hasFile('photo')){
            //upload file
            $imageName=$supplier->id.'.'.$request->photo->extension();			
            $request->photo->move(public_path('img'),$imageName);

            //update database
            $supplier->photo=$imageName;
            $supplier->update();
            }


            
        return redirect("suppliers");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier=Supplier::find($id);
        return view("pages.supplier.show",["supplier"=>$supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier=Supplier::find($id);
        return view("pages.supplier.edit",["supplier"=>$supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->name=$request->name;
        $supplier->mobile=$request->mobile;
        $supplier->email=$request->email;

        $supplier->update();

            if($request->hasFile('photo')){
                //upload file
                $imageName=$supplier->id.'.'.$request->photo->extension();			
                $request->photo->move(public_path('img'),$imageName);
    
                //update database
                $supplier->photo=$imageName;
                $supplier->update();
            }
    
        return redirect("suppliers");
    }

    /**
     * Remove the specified (Optional) resource from storage.
     */
    public function delete($id)
    {
            $supplier=Supplier::find($id);
            return view("pages.supplier.delete", ["supplier"=>$supplier]);
    }
        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
            $supplier->delete();
            return redirect("suppliers");
    }
}
