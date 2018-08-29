<?php

namespace App\Http\Middleware;

use App\Booking;
use App\Customer;
use App\Itinerary;
use App\Review;
use App\Tour;
use App\Trip;
use App\User;
use App\Vehicle;
use Closure;
use Illuminate\Support\Facades\View;

class InjectCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        View::share('booking_count', Booking::withoutTrashed()->count());
        View::share('booking_trashed_count', Booking::onlyTrashed()->count());
        View::share('customer_count', Customer::withoutTrashed()->count());
        View::share('customer_trashed_count', Customer::onlyTrashed()->count());
        View::share('itinerary_count', Itinerary::withoutTrashed()->count());
        View::share('itinerary_trashed_count', Itinerary::onlyTrashed()->count());
        View::share('review_count', Review::withoutTrashed()->count());
        View::share('review_trashed_count', Review::onlyTrashed()->count());
        View::share('tour_count', Tour::withoutTrashed()->count());
        View::share('tour_trashed_count', Tour::onlyTrashed()->count());
        View::share('trip_count', Trip::withoutTrashed()->count());
        View::share('trip_trashed_count', Trip::onlyTrashed()->count());
        View::share('vehicle_count', Vehicle::withoutTrashed()->count());
        View::share('vehicle_trashed_count', Vehicle::onlyTrashed()->count());
        View::share('staff_count', 0);
        View::share('staff_trashed_count', 0);
        return $next($request);
    }
}
