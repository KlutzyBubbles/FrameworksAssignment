@extends('layouts.no-navigation')

@section('title', '404 Error')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="display-1">404</h1>
            <h1 class="display-3 d-none d-md-block">Page Not Found</h1>
            <p class="lead">It seems you have found your way to no where, please <a href="{{ url('/') }}">take me home</a></p>
        </div>
    </div>
@endsection
