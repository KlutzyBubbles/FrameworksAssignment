@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-nowrap text-left">View Customer ID#{{ $data->id }}{!! !$data->trashed() ? '' : ' <small class="lead text-danger">Deleted on ' . $data->deleted_at . '</small>' !!}</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <h1 class="display-4">{{ $data->first_name }} {{ $data->middle_initial }} {{ $data->last_name }}</h1>
            <p>{{ $data->description }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-7">
            <h5>Email</h5>
            <p>{{ $data->email }}</p>
        </div>
        <div class="col-12 col-md-5">
            <h5>Phone</h5>
            <p>{{ $data->phone }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5>Address</h5>
            <p>{{ $data->street_no }} {{ $data->street_name }}, {{ $data->suburb }} {{ $data->postcode }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if ($data->enabled)
                <p class="text-success">This customer is currently enabled</p>
            @else
                <p class="text-danger">This customer is currently disabled</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <h3>Bookings</h3>
            <table class="table table-hover table-striped table-clickable">
                @include('include.inner-list', ['resource' => 'booking', 'columns' => ['ID' => 'id', 'Booking Date' => 'booking_date', 'Amount' => 'total_amount', 'Trip No.' => 'trip_id'], 'data' => $bookings])
            </table>
        </div>
        <div class="col-12 col-md-6">
            <h3>Reviews</h3>
            <table class="table table-hover table-striped table-clickable">
                @include('include.inner-list', ['resource' => 'review', 'columns' => ['ID' => 'id', 'Tour No.' => 'tour_id', 'Rating' => 'rating', 'Feedback' => 'feedback'], 'data' => $reviews])
            </table>
        </div>
    </div>
    <div class="row">
        <p class="col-12 col-sm-6 float-left">Created on {{ $data->created_at }}</p>
        <p class="col-12 col-sm-6 float-right text-right">Last edited on {{ $data->updated_at }}</p>
    </div>
    <div class="form-group row">
        <div class="col-4">
            <a class="btn btn-outline-dark" href="{{ route('customer.index') }}">
                Back
            </a>
        </div>
        <div class="col-8">
            @if ($data->trashed())
                <div class="btn-group float-right" role="group" aria-label="Actions">
                    <a href="{{ url('/customer/' . $data->id . '/edit') }}" class="btn btn-light"><i class="material-icons">restore</i> Restore</a>
                    <a href="{{ url('/customer/' . $data->id . '/destroy') }}" class="btn btn-dark"><i class="material-icons">delete</i> Permanently Delete</a>
                </div>
            @else
                <div class="btn-group float-right" role="group" aria-label="Actions">
                    @if (Auth::user()->isAdmin())
                        <a href="{{ url('/customer/' . $data->id . '/edit') }}" class="btn btn-warning btn-block"><i class="material-icons">edit</i> Edit</a>
                        <a href="{{ url('/customer/' . $data->id . '/destroy') }}" class="btn btn-danger"><i class="material-icons">delete</i> Delete</a>
                    @endif
                    @if ($data->enabled)
                        <a href="{{ url('/customer/disable/' . $data->id) }}" class="btn btn-danger"><i class="material-icons">toggle_on</i> Disable</a>
                    @else
                        <a href="{{ url('/customer/enable/' . $data->id) }}" class="btn btn-success"><i class="material-icons">toggle_off</i> Enable</a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
