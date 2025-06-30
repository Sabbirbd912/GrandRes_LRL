<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sales\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["customers"=>Customer::All()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Form Validation

        //   $request->validate([
        //     'name'  => 'required|string|max:255',
        //     'email' => 'required',
        //     'photo' => 'required|image|max:2048',
        //   ]);
              
        $extension =$request->photo->extension();
        $filename = $request->mobile . '.' . $extension;

     
        // $customer = Customer::create([
        //     'name'   => $request->name,
        //     'email'  => $request->email,
        //     'mobile' => $request->mobile,
        //     'photo'  => $filename,
        // ]);

         $customer=Customer();         
         $customer->name=$request->name;
         $customer->email=$request->email;
         $customer->mobile=$request->mobile;
         $customer->photo=$filename;
         $customer->save();

        //upload file
      if($request->hasFile('photo')){  
						
			$request->photo->move(public_path('img'),$filename);
           
		}
           
       //Response
        return response()->json([
            'message' => 'Customer saved successfully'           
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
       return response()->json(Customer::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $extension="";
        $filename="";
        if($request->hasFile('photo')){
            $extension =$request->photo->extension();
            $filename = $request->mobile . '.' . $extension;     
        }
         $customer=Customer::find($id);         
         $customer->name=$request->name;
         $customer->email=$request->email;
         $customer->mobile=$request->mobile;
         $customer->photo=$filename;
         $customer->update();

        //upload file
      if($request->hasFile('photo')){						
			$request->photo->move(public_path('img'),$filename);           
		}
           
           
       return response()->json([
            'message' => "Successfully updated"          
        ]);
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::find($id)->delete();
       return json_encode(["message"=>"Successfully Deleted"]);
    }
}
