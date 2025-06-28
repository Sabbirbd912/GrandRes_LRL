<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Libraries\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers=DB::table("customers")->get();
        return view("pages.customer.index",["customers"=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.customer.create');
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
        $customer->save();

            if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $imageName = uniqid('customer_') . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('img/customers'), $imageName);

            $customer->photo = 'customers/' . $imageName;
            $customer->update();
        }
        return redirect("customers");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer=Customer::find($id);
        return view("pages.customer.show", ["customer"=>$customer]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer=Customer::find($id);
        return view("pages.customer.edit", ["customer"=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
    {
        $customer->name=$request->name;
        $customer->mobile=$request->mobile;
        $customer->email=$request->email;
        $customer->address=$request->address;
        $customer->update();



            if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $imageName = uniqid('customer_') . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('img/customers'), $imageName);

            $customer->photo = 'customers/' . $imageName;
            $customer->update();
        }
        return redirect("customers");

    }

    /**
     * Remove the specified (optional) resource from storage.
     */
    public function delete($id)
    {
        $customer=Customer::find($id);
        return view("pages.customer.delete", ["customer"=>$customer]);
    }
        /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        $customer->delete();
        return redirect("customers");
    }
}
