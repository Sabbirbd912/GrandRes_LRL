<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = ["customers"=>Customer::all()];
        return response()->json($customer);
    }

    public function find($id)
    {
        $customer=Customer::find($id);
        return response()->json(["customer"=>$customer]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer=new Customer();
        $customer->name=$request->name;
        $customer->mobile=$request->mobile;
        $customer->email=$request->email;
        $customer->address=$request->address;
        $customer->photo=$request->photo;
        $customer->save();
        

        if($request->hash_file('photo')) {
            $imageName = $product->id. '.' . $request->photo->extension();
            $request->photo->move(public_path('img'),$imageName);

            $customer->photo = $imageName;
            $customer->update();
        }
        return response()->json(['success'=>'Customer saved', 'data'=>$customer],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }
    
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->email = $request->email;
        $customer->address = $request->address;

        if ($request->hasFile('photo')) {
            $imageName = $customer->id . '.' . $request->photo->extension();
            $request->photo->move(public_path('img'), $imageName);
            $customer->photo = $imageName;
        }
        $customer->save();
        return response()->json(['success' => 'Customer Updated', 'data' => $customer], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json(['sucess' => 'Customer deleted']);
    }
}
