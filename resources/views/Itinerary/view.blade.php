@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-nowrap text-left">View Itinerary ID#{{ $data->id }}{!! !$data->trashed() ? '' : ' <small class="lead text-danger">Deleted on ' . $data->deleted_at . '</small>' !!}</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <p>Apart of Tour <a href="{{ url('tour/' . $tour->id) }}">#{{ $tour->id }} - {{ $tour->name }}</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-5">
            <h5>Day No.</h5>
            <p>{{ $data->day_no }}</p>
        </div>
        <div class="col-12 col-md-7">
            <h5>Hotel Booking</h5>
            <p>{{ $data->hotel_booking }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <h5>Activities</h5>
            <p>{{ $data->activities == null ? 'N/A' : $data->activities }}</p>
        </div>
        <div class="col-12 col-md-6">
            <h5>Meals</h5>
            <p>{{ $data->meals == null ? 'N/A' : $data->meals }}</p>
        </div>
    </div>
    <div class="row">
        <p class="col-12 col-sm-6 float-left">Created on {{ $data->created_at }}</p>
        <p class="col-12 col-sm-6 float-right text-right">Last edited on {{ $data->updated_at }}</p>
    </div>
    <div class="form-group row">
        <div class="col-4">
            <a class="btn btn-outline-dark" href="{{ route('itinerary.index') }}">
                Back
            </a>
        </div>
        <div class="col-8">
            @if ($data->trashed())
                <div class="btn-group float-right" role="group" aria-label="Actions">
                    <a href="{{ url('/itinerary/' . $data->id . '/edit') }}" class="btn btn-light"><i class="material-icons">restore</i> Restore</a>
                    <a href="{{ url('/itinerary/' . $data->id . '/destroy') }}" class="btn btn-dark"><i class="material-icons">delete</i> Permanently Delete</a>
                </div>
            @else
                <div class="btn-group float-right" role="group" aria-label="Actions">
                    <a href="{{ url('/itinerary/' . $data->id . '/edit') }}" class="btn btn-warning btn-block"><i class="material-icons">edit</i> Edit</a>
                    <a href="{{ url('/itinerary/' . $data->id . '/destroy') }}" class="btn btn-danger"><i class="material-icons">delete</i> Delete</a>
                </div>
            @endif
        </div>
    </div>
@endsection
