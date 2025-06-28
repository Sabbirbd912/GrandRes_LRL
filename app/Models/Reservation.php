<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // যদি আপনার টেবিলের নাম core_reservations হয় (prefix সহ)
    protected $table = 'reservations';

    // যেসব ফিল্ড mass-assign করা যাবে
    protected $fillable = [
        'customer_id',
        'table_id',
        'reservation_date',
        'reservation_time',
        'status', // ✅ status কলাম যুক্ত করা হয়েছে
    ];

    // সম্পর্ক: একটি রিজারভেশন একটি কাস্টমারের
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // সম্পর্ক: একটি রিজারভেশন একটি টেবিলের
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function releaseTable()
    {
        $table = Table::find($reservation->table_id);
        if ($table) {
        $table->status = 0; // Available
        $table->save();
        }
    }
    public function autoReserveAndConfirm($table_id, $customer_id)
    {
        $reservation = new Reservation();
        $reservation->customer_id = $customer_id;
        $reservation->table_id = $table_id;
        $reservation->reservation_date = date('Y-m-d');
        $reservation->reservation_time = date('H:i:s');
        $reservation->status = 1; // Directly Confirmed
        $reservation->save();

        $table = Table::find($table_id);
        if ($table) {
            $table->status = 1; // Booked
            $table->save();
        }

        return response()->json(['success' => true, 'message' => 'Auto Reserved & Confirmed']);
    }

}
