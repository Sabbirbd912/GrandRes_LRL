<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Table;

class AutoReservationController extends Controller
{
    public function reserve(Request $request)
    {
        // ✅ Validation (Optional but good)
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'table_id' => 'required|exists:tables,id',
        ]);

        // ✅ Create reservation
        $reservation = new Reservation();
        $reservation->customer_id = $request->customer_id;
        $reservation->table_id = $request->table_id;
        $reservation->reservation_date = date("Y-m-d");
        $reservation->reservation_time = date("H:i:s");
        $reservation->status = 1; // Confirmed
        $reservation->save();

        // ✅ Update table status to booked
        $table = Table::find($request->table_id);
        if ($table) {
            $table->status = 1;
            $table->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Table auto-reserved and confirmed.'
        ]);
    }
}
