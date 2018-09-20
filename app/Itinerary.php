<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itinerary extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['tour_id', 'day_no', 'hotel_booking', 'activities', 'meals'];

    public function tour() {
        return $this->belongsTo('App\Tour');
    }
}
