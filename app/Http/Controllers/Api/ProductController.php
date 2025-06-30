<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = Product::paginate(request()->all());    
        //return response()->json(["products"=>$data],1);

        return response()->json(["products"=>Product::All()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $product=new Product;
        $product->name="Apple";
        $product->offer_price=345;
        $product->manufacturer_id=1;
        $product->regular_price=400;
        $product->description="NA";

        if(isset($request->photo)){
           $product->photo=$request->photo;
        }else{
            $product->photo="default.jpg";
        }
        $product->product_category_id=1;
        $product->product_section_id=1;
        $product->product_type_id=1;
        $product->is_featured=0;
        $product->star=5;
        $product->is_brand=1;
        $product->offer_discount=0;
        $product->uom_id=1;
        $product->weight=0;
        $product->barcode=1002;

        $product->save();

        if(isset($request->photo)){
            $imageName = $product->id.'.'.$request->photo->extension();
            $product->photo=$imageName;
            $product->update();
            $request->photo->move(public_path('img'),$imageName);
        }
      */


       
        $product=new Product;
        $product->name=$request->name;
        $product->offer_price=$request->offer_price;
        $product->manufacturer_id=$request->manufacturer_id;
        $product->regular_price=$request->regular_price;
        $product->description=$request->description;
        if(isset($request->photo)){
           $product->photo=$request->photo;
        }
        $product->product_category_id=$request->product_category_id;
        $product->product_section_id=$request->product_section_id;
        $product->product_type_id=1;
        $product->is_featured=$request->is_featured;
        $product->star=$request->star;
        $product->is_brand=$request->is_brand;
        $product->offer_discount=$request->offer_discount;
        $product->uom_id=$request->uom_id;
        $product->weight=$request->weight;
        $product->barcode=$request->barcode;

        $product->save();
        if(isset($request->photo)){
            $imageName = $product->id.'.'.$request->photo->extension();
            $product->photo=$imageName;
            $product->update();
            $request->photo->move(public_path('img'),$imageName);
        }
  
        
        //return response()->json(['success'=>'Saved']);
        return json_encode(['success'=>'Saved']);
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)    {
        return json_encode(["product"=>Product::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        /*
        $product=Product::find($id);

		$product->name=$request->name;
		$product->offer_price=$request->offer_price;
		$product->manufacturer_id=$request->manufacturer_id;
		$product->regular_price=$request->regular_price;
		$product->description=$request->description;

		if(isset($request->photo)){
		    $product->photo=$request->photo;
		}

		$product->product_category_id=$request->product_category_id;
		$product->product_section_id=$request->product_section_id;
        $product->product_type_id=1;
		$product->is_featured=$request->is_featured;
		$product->star=$request->star;
		$product->is_brand=$request->is_brand;
		$product->offer_discount=$request->offer_discount;
		$product->uom_id=$request->uom_id;
		$product->weight=$request->weight;
		$product->barcode=$request->barcode;

		if(isset($request->photo)){
			$imageName = $product->id.'.'.$request->photo->extension();
			$product->photo=$imageName;
			$request->photo->move(public_path('img'),$imageName);
		}
		$product->update();
      */

		return json_encode(["success"=>$request->star,"ID"=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
		return json_encode(["success"=>$id]);
    }
}
