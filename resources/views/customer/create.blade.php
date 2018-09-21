@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-nowrap text-left">Add Customer</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form class="form-horizontal" method="POST" action="{{ route('customer.store') }}">
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
                    <label for="street_no" class="col-md-4 col-lg-3 control-label lead">Street <small class="font-weight-light text-danger">Required</small></label>

                    <div class="col-4 col-md-2">
                        <input id="street_no" type="text" placeholder="No." class="form-control{{ $errors->has('street_no') ? ' is-invalid' : '' }}" name="street_no" value="{{ old('street_no') }}" required autofocus>

                        @if ($errors->has('street_no'))
                            <div class="invalid-feedback">
                                {{ $errors->first('street_no') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-8 col-md-6 col-lg-7">
                        <input id="street_name" type="text" placeholder="Street Name" class="form-control{{ $errors->has('street_name') ? ' is-invalid' : '' }}" name="street_name" value="{{ old('street_name') }}" required autofocus>

                        @if ($errors->has('street_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('street_name') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="suburb" class="col-md-4 col-lg-3 control-label lead">Suburb <small class="font-weight-light text-danger">Required</small></label>

                    <div class="col-8 col-md-6 col-lg-7">
                        <input id="suburb" type="text" placeholder="Suburb" class="form-control{{ $errors->has('suburb') ? ' is-invalid' : '' }}" name="suburb" value="{{ old('suburb') }}" required autofocus>

                        @if ($errors->has('suburb'))
                            <div class="invalid-feedback">
                                {{ $errors->first('suburb') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-4 col-md-2">
                        <input id="postcode" type="number" step="1" min="100" max="9999" placeholder="Postcode" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}" name="postcode" value="{{ old('postcode') }}" required autofocus>

                        @if ($errors->has('postcode'))
                            <div class="invalid-feedback">
                                {{ $errors->first('postcode') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-lg-3 control-label lead">Email <small class="font-weight-light text-danger">Required</small></label>

                    <div class="col-12 col-md-8 col-lg-9">
                        <input id="email" type="email" placeholder="Example@gmail.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-lg-3 control-label lead">Phone</label>

                    <div class="col-12 col-md-8 col-lg-9">
                        <input id="phone" type="text" placeholder="1234567890" minlength="8" maxlength="10" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                        @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12 col-md-4 col-lg-3">
                        &nbsp;
                    </div>
                    <div class="custom-control custom-checkbox col-12 col-md-8 col-lg-9">
                        <input type="checkbox" class="custom-control-input position-static" id="enabled" name="enabled">
                        <label class="custom-control-label" for="enabled">Enabled</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-4">
                        <a class="btn btn-outline-dark" href="{{ route('customer.index') }}">
                            Cancel
                        </a>
                    </div>
                    <div class="col-8">
                        <button type="submit" class="btn btn-success d-block ml-auto">
                            Add Customer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
