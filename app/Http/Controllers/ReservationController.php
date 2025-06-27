<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with('customer')->get();
        return view("pages.reservation.index", ["reservations" => $reservations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('status', 0)->get(); // Only available tables
        $customers = Customer::all(); // All customers
        return view('pages.reservation.create', compact('tables', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reservation = new Reservation();
        $reservation->customer_id = $request->customer_id;
        $reservation->table_id = $request->table_id;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_time = $request->reservation_time;
        $reservation->status = 0; // Default: Pending
        $reservation->save();

        // Mark table as booked
        $table = Table::find($request->table_id);
        if ($table) {
            $table->status = 1;
            $table->save();
        }

        return redirect("reservations")->with('success', 'Reservation created and table booked.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservation = Reservation::with(['customer', 'table'])->findOrFail($id);
        return view("pages.reservation.show", ["reservation" => $reservation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $customers = Customer::all();
        $tables = Table::all();

        return view('pages.reservation.edit', compact('reservation', 'customers', 'tables'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->customer_id = $request->customer_id;
        $reservation->table_id = $request->table_id;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_time = $request->reservation_time;
        $reservation->update();

        return redirect("reservations")->with('success', 'Reservation updated.');
    }

    /**
     * Show the delete confirmation view.
     */
    public function delete($id)
    {
        $reservation = Reservation::with(['customer', 'table'])->findOrFail($id);
        return view("pages.reservation.delete", ["reservation" => $reservation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        if ($reservation) {
            $table = Table::find($reservation->table_id);
            if ($table) {
                $table->status = 0; // Set table to available
                $table->save();
            }

            $reservation->delete();
            return redirect("reservations")->with('success', 'Reservation deleted and table released.');
        }

        return redirect("reservations")->with('error', 'Reservation not found.');
    }

    /**
     * Confirm the reservation.
     */
    public function confirm($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 1; // Confirmed
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation confirmed.');
    }

    /**
     * Cancel the reservation and free the table.
     */
    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 2; // Cancelled
        $reservation->save();

        $this->releaseTable($reservation);

        return redirect()->back()->with('success', 'Reservation cancelled. Table is now available.');
    }

    /**
     * Checkout the customer and free the table.
     */
    public function checkout($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 3; // Checked Out
        $reservation->save();

        // ✅ টেবিল রিলিজ
        $this->releaseTable($reservation); // এই ফাংশন নিচে থাকবে

        return redirect()->back()->with('success', 'Customer checked out. Table is now available.');
    }

    // ✅ এই ফাংশনটি ReservationController-এর মধ্যেই লিখতে হবে:
    private function releaseTable(Reservation $reservation)
    {
        $table = Table::find($reservation->table_id);
        if ($table) {
            $table->status = 0;
            $table->save();
        }
    }

}