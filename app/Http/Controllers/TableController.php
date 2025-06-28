<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
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

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $imageName = uniqid('table_') . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('img/tables'), $imageName);

            $table->photo = 'tables/' . $imageName;
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
        $table->name = $request->name;
        $table->status = $request->status;
        $table->seats = $request->seats;

        if ($request->hasFile('photo')) {
            // পুরনো ছবি থাকলে মুছে ফেলি
            if ($table->photo && file_exists(public_path('img/' . $table->photo))) {
                unlink(public_path('img/' . $table->photo));
            }

            $photo = $request->file('photo');
            $imageName = uniqid('table_') . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('img/tables'), $imageName);

            $table->photo = 'tables/' . $imageName;
        }

        $table->update();

        return redirect('tables');
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
            $table->status = 1;
            $table->save();
        }

        return redirect('orders/create?table_id=' . $id);
    }



}
