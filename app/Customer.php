<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['first_name',
                            'middle_initial',
                            'last_name',
                            'street_no',
                            'street_name',
                            'suburb',
                            'postcode',
                            'email',
                            'phone',
                            'enabled'];

    public function reviews() {
        return $this->hasMany('App\Review');
    }

    public function bookings() {
        return $this->hasMany('App\Booking');
    }
}
