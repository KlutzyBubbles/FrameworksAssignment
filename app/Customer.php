<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function reviews() {
        return $this->hasMany('App\Review');
    }

    public function bookings() {
        return $this->hasMany('App\Booking');
    }
}
