<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Customer;
use App\Libraries\Core\File;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $reservations=DB::table("reservations")->get();
        $reservations = Reservation::with('customer')->get();
        return view("pages.reservation.index", ["reservations"=>$reservations]);
    }

    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    $tables = Table::where('status', 0)->get(); // শুধু খালি টেবিল
    $customers = Customer::all(); // কাস্টমার লিস্ট
    return view('pages.reservation.create', compact('tables', 'customers'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reservation=new Reservation();
        $reservation->customer_id=$request->customer_id;
        $reservation->table_id=$request->table_id;
        $reservation->reservation_date=$request->reservation_date;
        $reservation->reservation_time=$request->reservation_time;
        $reservation->save();

        // 2. Table এর status = 1 (Booked) করে দিন
        $table = \App\Models\Table::find($request->table_id);
        $table->status = 1;
        $table->save();

        return redirect("reservations");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservation=Reservation::find($id);
        return view("pages.reservation.show",["reservation"=>$reservation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reservation=Reservation::find($id);
        return view("pages.reservation.edit", ["reservation"=>$reservation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->customer_id=$request->customer_id;
        $reservation->table_id=$request->table_id;
        $reservation->reservation_date=$request->reservation_date;
        $reservation->reservation_time=$request->reservation_time;
        $reservation->update();
        
        return redirect ("reservations");
    }

    /**
     * Remove the specified (optional) resource from storage.
     */
    public function delete($id)
    {
        $reservation=Reservation::find($id);
        return view("pages.reservation.delete",["reservation"=>$reservation]);
    }
        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {

        // টেবিল খালি (Available) করে দিন
        $table = \App\Models\Table::find($reservation->table_id);
        $table->status = 0;
        $table->save();

        // রিজারভেশন ডিলিট
        $reservation->delete();
        return redirect("reservations");
    }

public function confirm($id)
{
    $reservation = Reservation::findOrFail($id);
    if (!$reservation) {
    dd('Reservation not found!');
    }
    $reservation->status = 1; // Confirmed
    $reservation->save();
    dd('Updated successfully');
    return redirect()->back()->with('success', 'Reservation Confirmed');
}

public function cancel($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->status = 2; // Cancelled
    $reservation->save();

    $reservation->releaseTable();

    return redirect()->back()->with('success', 'Reservation cancelled and table is now available.');
}


public function checkout($id)
{
    $reservation = Reservation::findOrFail($id);
    $reservation->status = 3; // Checked Out
    $reservation->save();

    $reservation->releaseTable();

    return redirect()->back()->with('success', 'Customer checked out. Table is now available.');
}


}
