@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-nowrap text-left">Add Tour</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form class="form-horizontal" method="POST" action="{{ route('tour.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 control-label lead">Tour Name <small class="font-weight-light text-danger">Required</small></label>

                    <div class="col-xs-12 col-md-8">
                        <input id="name" type="text" placeholder="Example Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 control-label lead">Description <small class="font-weight-light text-danger">Required</small></label>

                    <div class="col-xs-12 col-md-8">
                        <textarea id="description" type="password" placeholder="Example description for this amazing tour" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required>
                            {{ old('description') }}
                        </textarea>

                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="duration" class="col-md-4 control-label lead">Duration</label>

                    <div class="col-xs-12 col-md-8">
                        <input id="duration" type="number" step="0.1" min="0" placeholder="4.5" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{ old('duration') }}">

                        @if ($errors->has('duration'))
                            <div class="invalid-feedback">
                                {{ $errors->first('duration') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="route_map" class="col-md-4 control-label lead">Route Map</label>

                    <div class="col-xs-12 col-md-8">
                        <input id="route_map" type="text" placeholder="https://www.domain.ext/image-name.img-extension" class="form-control{{ $errors->has('route_map') ? ' is-invalid' : '' }}" name="route_map" value="{{ old('route_map') }}">

                        @if ($errors->has('route_map'))
                            <div class="invalid-feedback">
                                {{ $errors->first('route_map') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-4">
                        <a class="btn btn-outline-dark" href="{{ route('tour.index') }}">
                            Cancel
                        </a>
                    </div>
                    <div class="col-8">
                        <button type="submit" class="btn btn-success d-block ml-auto">
                            Add Tour
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
