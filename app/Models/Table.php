<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function isAvailable()
    {
        return $this->status == 0;
    }

    /**
     * One-to-One relationship with Reservation
     */
    public function reservation()
    {
        return $this->hasOne(\App\Models\Reservation::class, 'table_id');
    }
}
