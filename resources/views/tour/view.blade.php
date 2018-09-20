@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-nowrap text-left">View Tour ID#{{ $data->id }}{!! !$data->trashed() ? '' : ' <small class="lead text-danger">Deleted on ' . $data->deleted_at . '</small>' !!}</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <h1 class="display-4">{{ $data->name }}</h1>
            <p>{{ $data->description }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-5">
            <h5>Duration</h5>
            <p>{{ $data->duration == null ? 'N/A' : $data->duration }}</p>
        </div>
        <div class="col-12 col-md-7">
            <h5>Route Map</h5>
            <p>{{ $data->route_map == null ? 'N/A' : $data->route_map }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <h3>Itineraries</h3>
            <table class="table table-hover table-striped table-clickable">
                @include('include.inner-list', ['resource' => 'itinerary', 'columns' => ['ID' => 'id', 'Day No.' => 'day_no'], 'data' => $itineraries])
            </table>
        </div>
        <div class="col-12 col-md-6">
            <h3>Trips</h3>
            <table class="table table-hover table-striped table-clickable">
                @include('include.inner-list', ['resource' => 'trip', 'columns' => ['ID' => 'id', 'Departure' => 'departure_date'], 'data' => $trips])
            </table>
        </div>
    </div>
    <div class="row">
        <p class="col-12 col-sm-6 float-left">Created on {{ $data->created_at }}</p>
        <p class="col-12 col-sm-6 float-right text-right">Last edited on {{ $data->updated_at }}</p>
    </div>
    <div class="form-group row">
        <div class="col-4">
            <a class="btn btn-outline-dark" href="{{ route('tour.index') }}">
                Back
            </a>
        </div>
        <div class="col-8">
            @if ($data->trashed())
                <div class="btn-group float-right" role="group" aria-label="Actions">
                    <a href="{{ url('/tour/' . $data->id . '/edit') }}" class="btn btn-light"><i class="material-icons">restore</i> Restore</a>
                    <a href="{{ url('/tour/' . $data->id . '/destroy') }}" class="btn btn-dark"><i class="material-icons">delete</i> Permanently Delete</a>
                </div>
            @else
                <div class="btn-group float-right" role="group" aria-label="Actions">
                    <a href="{{ url('/tour/' . $data->id . '/edit') }}" class="btn btn-warning btn-block"><i class="material-icons">edit</i> Edit</a>
                    <a href="{{ url('/tour/' . $data->id . '/destroy') }}" class="btn btn-danger"><i class="material-icons">delete</i> Delete</a>
                </div>
            @endif
        </div>
    </div>
@endsection
