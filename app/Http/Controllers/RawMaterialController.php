<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raw_materials = RawMaterial::all();
        return view("pages.raw_material.index", compact('raw_materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.raw_material.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $raw_material=new RawMaterial();
        $raw_material->name=$request->name;
        $raw_material->qty=$request->qty;
        $raw_material->price=$request->price;
        $raw_material->save();

        return redirect ("raw_materials");
    }

    /**
     * Display the specified resource.
     */
    public function show(RawMaterial $rawMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RawMaterial $rawMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RawMaterial $rawMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RawMaterial $rawMaterial)
    {
        //
    }
}
