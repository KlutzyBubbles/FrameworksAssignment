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
                    <label for="first_name" class="d-block d-lg-none col-md-4 control-label lead">First Name <small class="font-weight-light text-danger">Required</small></label>

                    <label for="first_name" class="d-none d-lg-block col-md-4 col-lg-3 control-label lead">Name <small class="font-weight-light text-danger">Required</small></label>

                    <div class="col-8 col-md-6 col-lg-3">
                        <input id="first_name" type="text" placeholder="First Name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus/>

                        @if ($errors->has('first_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('first_name') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-4 col-md-2">
                        <input id="middle_initial" type="text" placeholder="Initial" class="form-control{{ $errors->has('middle_initial') ? ' is-invalid' : '' }}" name="middle_initial" value="{{ old('middle_initial') }}"/>

                        @if ($errors->has('middle_initial'))
                            <div class="invalid-feedback">
                                {{ $errors->first('middle_initial') }}
                            </div>
                        @endif
                    </div>

                    <label for="last_name" class="d-block d-lg-none col-md-4 control-label lead pt-2 pt-lg-0">Last Name <small class="font-weight-light text-danger">Required</small></label>

                    <div class="col-12 col-md-8 col-lg-4 pt-0 pt-md-1 pt-lg-0">
                        <input id="last_name" type="text" placeholder="Last Name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required/>

                        @if ($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                    </div>
                </div>

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
