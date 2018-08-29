<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Navigation</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Phoenix Travel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-content">
            <ul class="navbar-nav ml-auto">
                @if (Auth::check())
                    <li class="nav-item text-center"><a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-center" href="#" id="viewDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            View all...
                        </a>
                        <div class="dropdown-menu" aria-labelledby="viewDropdown">
                            <a class="dropdown-item" href="{{ url('/booking') }}">
                                Bookings
                                <span class="badge badge-info">{{ $booking_count }}</span>
                                @if (Auth::user()->isAdmin())
                                    <span class="badge badge-danger">{{ $booking_trashed_count }}</span>
                                @endif
                            </a>
                            <a class="dropdown-item" href="{{ url('/customer') }}">
                                Customers
                                <span class="badge badge-info">{{ $customer_count }}</span>
                                @if (Auth::user()->isAdmin())
                                    <span class="badge badge-danger">{{ $customer_trashed_count }}</span>
                                @endif
                            </a>
                            <a class="dropdown-item" href="{{ url('/itinerary') }}">
                                Itineraries
                                <span class="badge badge-info">{{ $itinerary_count }}</span>
                                @if (Auth::user()->isAdmin())
                                    <span class="badge badge-danger">{{ $itinerary_trashed_count }}</span>
                                @endif
                            </a>
                            <a class="dropdown-item" href="{{ url('/review') }}">
                                Reviews
                                <span class="badge badge-info">{{ $review_count }}</span>
                                @if (Auth::user()->isAdmin())
                                    <span class="badge badge-danger">{{ $review_trashed_count }}</span>
                                @endif
                            </a>
                            <a class="dropdown-item" href="{{ url('/tour') }}">
                                Tours
                                <span class="badge badge-info">{{ $tour_count }}</span>
                                @if (Auth::user()->isAdmin())
                                    <span class="badge badge-danger">{{ $tour_trashed_count }}</span>
                                @endif
                            </a>
                            <a class="dropdown-item" href="{{ url('/trip') }}">
                                Trips
                                <span class="badge badge-info">{{ $trip_count }}</span>
                                @if (Auth::user()->isAdmin())
                                    <span class="badge badge-danger">{{ $trip_trashed_count }}</span>
                                @endif
                            </a>
                            <a class="dropdown-item" href="{{ url('/vehicle') }}">
                                Vehicles
                                <span class="badge badge-info">{{ $vehicle_count }}</span>
                                @if (Auth::user()->isAdmin())
                                    <span class="badge badge-danger">{{ $vehicle_trashed_count }}</span>
                                @endif
                            </a>
                            @if (Auth::user()->isAdmin())
                            <a class="dropdown-item" href="{{ url('/staff') }}">
                                Staff
                                <span class="badge badge-info">{{ $staff_count }}</span>
                                <span class="badge badge-danger">{{ $staff_trashed_count }}</span>
                            </a>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-success text-light" href="#" id="viewDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Create...
                        </a>
                        <div class="dropdown-menu" aria-labelledby="viewDropdown">
                            <a class="dropdown-item" href="{{ url('/booking/create') }}">Booking</a>
                            <a class="dropdown-item" href="{{ url('/customer/create') }}">Customer</a>
                            <a class="dropdown-item" href="{{ url('/itinerary/create') }}">Itinerary</a>
                            <a class="dropdown-item" href="{{ url('/review/create') }}">Review</a>
                            <a class="dropdown-item" href="{{ url('/tour/create') }}">Tour</a>
                            <a class="dropdown-item" href="{{ url('/trip/create') }}">Trip</a>
                            <a class="dropdown-item" href="{{ url('/vehicle/create') }}">Vehicle</a>
                            @if (Auth::user()->isAdmin())
                            <a class="dropdown-item" href="{{ url('/staff/create') }}">Staff</a>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item text-center"><a href="{{ url('/logout') }}" class="nav-link">Logout</a></li>
                @else
                    <li class="nav-item text-center"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                    <li class="nav-item text-center"><a href="{{ url('/login') }}" class="nav-link">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @if (session()->has('error'))
        @component('alert', ['type' => 'danger', 'dismiss' => true])
            {{ session()->get('error') }}
        @endcomponent
    @endif
    @if (session()->has('info'))
        @component('alert', ['type' => 'info', 'dismiss' => true])
            {{ session()->get('info') }}
        @endcomponent
    @endif
    @if (session()->has('success'))
        @component('alert', ['type' => 'success', 'dismiss' => true])
            {{ session()->get('success') }}
        @endcomponent
    @endif
    @if (session()->has('warning'))
        @component('alert', ['type' => 'warning', 'dismiss' => true])
            {{ session()->get('warning') }}
        @endcomponent
    @endif
    @yield('content')
</div>
<footer class="footer">
    <div class="container"><span class="text-muted">&copy; 2018 - Navigation</span></div>
</footer>

</body>
</html>
