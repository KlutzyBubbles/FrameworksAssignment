<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function tour() {
        return $this->belongsTo('App\Tour');
    }

    public function reviews() {
        return $this->hasMany('App\Review');
    }

    public function bookings() {
        return $this->hasMany('App\Booking');
    }

    public function vehicle() {
        return $this->belongsTo('App\Vehicle');
    }
}
