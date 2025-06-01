<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Libraries\Core\File;
use App\Models\ProductSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


class ProductController extends Controller
{
    function index()
        {
            $products=DB::table("products")->get();
            return view("pages.product.index",["products"=>$products]);
        }
    function create()
        {
            return view("pages.product.create");
        }
    function store(Request $request)
        {
            $product=new Product();
            $product->name=$request->name;
            $product->offer_price=$request->offer_price;
            $product->manufacturer_id=1;
            $product->regular_price=1;
            $product->description="Na";       
            $product->product_category_id=1;
            $product->product_section_id=1;
            $product->uom_id=1;
            $product->barcode="294394";
            $product->product_type_id=1;
            $product->product_unit_id=1;
            $product->star=1;
            $product->offer_discount=10;        
            $product->save();

            if($request->hasFile('photo')){
                //upload file
                $imageName=$product->id.'.'.$request->photo->extension();			
                $request->photo->move(public_path('img'),$imageName);

                //update database
                $product->photo=$imageName;
                $product->update();
            }

            return redirect("products");
        }

    function show($id)
        {
            $product=Product::find($id);
            return view("pages.product.show",["product"=>$product]);
        }
    function edit($id)
        {
            $product=Product::find($id);
            $sections=ProductSection::all();
            return view("pages.product.edit", ["product"=>$product, "sections"=>$sections]);
        }

        function update(Request $request,Product $product)
        {       
            $product->name=$request->name;
            $product->offer_price=$request->offer_price;
            $product->manufacturer_id=1;
            $product->regular_price=1;
            $product->description="Na";      
            $product->product_category_id=1;
            $product->product_section_id=$request->product_section_id;
            $product->uom_id=1;
            $product->barcode="294394";
            $product->product_type_id=1;
            $product->product_unit_id=1;
            $product->star=1;
            $product->offer_discount=10;      
            
            $product->update();
    
            if($request->hasFile('photo')){
                //upload file
                $imageName=$product->id.'.'.$request->photo->extension();			
                $request->photo->move(public_path('img'),$imageName);
    
                //update database
                $product->photo=$imageName;
                $product->update();
            }
    
            return redirect("products");
        }

    function confirm($id)
        {
            $product=Product::find($id);
            return view("pages.product.confirm", ["product"=>$product]);
        }
    function destroy(Product $product)
        {
            $product->delete();
            return redirect("products");
        }
}