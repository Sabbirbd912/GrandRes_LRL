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

        // যদি টেবিল ফাঁকা থাকে, তখনই বুক করব
        if ($table->status == 0) {
            $table->status = 1;
            $table->save();

            // ✅ Default বা logged-in কাস্টমার ID
            $defaultCustomerId = 40; // চাইলে Auth::id() ব্যবহার করতে পারেন

            // ✅ Current time
            $now = Carbon::now();

            // ✅ Reservation create & confirm
            $reservation = new Reservation();
            $reservation->customer_id = $defaultCustomerId;
            $reservation->table_id = $table->id;
            $reservation->reservation_date = $now->toDateString();
            $reservation->reservation_time = $now->format('H:i');
            $reservation->status = 1; // 🔥 Direct Confirmed
            $reservation->save();
        }

        return redirect('orders/create?table_id=' . $table->id)
            ->with('success', 'Table booked and reservation confirmed. You can now place the order.');
    }


}
