<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Libraries\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tables=DB::table("tables")->get();
        $tables = Table::with('reservation')->get(); // ✅ সঠিক
        return view("pages.table.index",["tables"=>$tables]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            return view('pages.table.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $table=new Table();
        $table->name=$request->name;
        $table->status=$request->status;
        $table->seats=$request->seats;
        $table->save();
            if($request->hasFile('photo')){
        //upload file
        $imageName=$table->id.'.'.$request->photo->extension();			
        $request->photo->move(public_path('img'),$imageName);

        //update database
        $table->photo=$imageName;
        $table->update();
        }
        return redirect("tables");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $table=Table::find($id);
        return view("pages.table.show", ["table"=>$table]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $table=Table::find($id);
        return view("pages.table.edit",["table"=>$table]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        $table->name=$request->name;
        $table->status=$request->status;
        $table->seats=$request->seats;
        
        $table->update();

            if($request->hasFile('photo')){
            //upload file
            $imageName=$table->id.'.'.$request->photo->extension();			
            $request->photo->move(public_path('img'),$imageName);

            //update database
            $table->photo=$imageName;
            $table->update();
        }
        return redirect("tables");
    }

    /**
     * Remove the specified resource from storage.
     */


    function confirm($id)
    {
        $table=Table::find($id);
        return view("pages.table.confirm", ["table"=>$table]);
    }
    public function destroy(Table $table)
    {
        $table->delete();
        return redirect ("tables");
    }

    public function book($id)
    {
        $table = Table::findOrFail($id);

        if ($table->status == 0) {
            $table->status = 1; // Mark as Booked
            $table->save();
        }

        // 🔁 Redirect to order create page
        return redirect('orders/create?table_id=' . $table->id)
            ->with('success', 'Table booked. Please place the order.');
    }


}
