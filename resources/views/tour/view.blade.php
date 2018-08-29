@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-nowrap text-left">View Tour ID#{{ $data->id }} <small class="lead text-danger">{{ $data->deleted_on === null ? '' : 'Deleted on ' . $data->deleted_on }}</small></h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <h1 class="display-4">{{ $data->name }}</h1>
            <p>{{ $data->description }}</p>
        </div>
    </div>
@endsection
