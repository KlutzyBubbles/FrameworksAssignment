<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function trip() {
        return $this->belongsTo('App\Trip');
    }

    public function customer() {
        return $this->belongsTo('App\Customer');
    }
}
