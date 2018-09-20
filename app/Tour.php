<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'description', 'duration', 'route_map'];

    public function itineraries() {
        return $this->hasMany('App\Itinerary');
    }

    public function trips() {
        return $this->hasMany('App\Trip');
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($m) {
            $m->itineraries()->delete();
            $m->trips()->delete();
        });
    }
}
