@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-nowrap text-left">Add Itinerary</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form class="form-horizontal" method="POST" action="{{ route('itinerary.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="tour_id" class="col-md-4 control-label lead">Tour <small class="font-weight-light text-danger">Required</small></label>

                    <div class="col-xs-12 col-md-8">
                        @include('include.select', ['name' => 'tour_id',
                                                    'required' => true,
                                                    'data' => $tours,
                                                    'display' => 'name',
                                                    'default' => $tours[0]->id])

                        @if ($errors->has('tour_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tour_id') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="day_no" class="col-md-4 control-label lead">Day No. <small class="font-weight-light text-danger">Required</small></label>

                    <div class="col-xs-12 col-md-8">
                        <input id="day_no" type="number" step="1" min="0" placeholder="4" class="form-control{{ $errors->has('day_no') ? ' is-invalid' : '' }}" name="day_no" value="{{ old('day_no') }}" autofocus>

                        @if ($errors->has('day_no'))
                            <div class="invalid-feedback">
                                {{ $errors->first('day_no') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="hotel_booking" class="col-md-4 control-label lead">Hotel Booking <small class="font-weight-light text-danger">Required</small></label>

                    <div class="col-xs-12 col-md-8">
                        <input id="hotel_booking" type="text" placeholder="A1B2C3" class="form-control{{ $errors->has('hotel_booking') ? ' is-invalid' : '' }}" name="hotel_booking" value="{{ old('hotel_booking') }}" required>

                        @if ($errors->has('hotel_booking'))
                            <div class="invalid-feedback">
                                {{ $errors->first('hotel_booking') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="activities" class="col-md-4 control-label lead">Activities</label>

                    <div class="col-xs-12 col-md-8">
                        <textarea id="activities" type="text" placeholder="Some example activities for this amazing itinerary" class="form-control{{ $errors->has('activities') ? ' is-invalid' : '' }}" name="activities">
                            {{ old('activities') }}
                        </textarea>

                        @if ($errors->has('activities'))
                            <div class="invalid-feedback">
                                {{ $errors->first('activities') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="meals" class="col-md-4 control-label lead">Meals</label>

                    <div class="col-xs-12 col-md-8">
                        <textarea id="meals" type="text" placeholder="Some example meals for this amazing itinerary" class="form-control{{ $errors->has('meals') ? ' is-invalid' : '' }}" name="meals">
                            {{ old('meals') }}
                        </textarea>

                        @if ($errors->has('meals'))
                            <div class="invalid-feedback">
                                {{ $errors->first('meals') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-4">
                        <a class="btn btn-outline-dark" href="{{ route('itinerary.index') }}">
                            Cancel
                        </a>
                    </div>
                    <div class="col-8">
                        <button type="submit" class="btn btn-success d-block ml-auto">
                            Add Itinerary
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
