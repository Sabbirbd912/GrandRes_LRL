<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}
