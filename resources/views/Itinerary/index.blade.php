@extends('layouts.app')

@section('content')
    <div class="row">
        @if (Auth::user()->isAdmin())
            <div class="col-sm-6 col-md-8">
                <h1 class="text-nowrap text-left">Itinerary Home</h1>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input show-trashed" id="show-trashed" {{ $showTrashed ? 'checked="checked"' : '' }}>
                    <label class="custom-control-label" for="show-trashed">Show Trashed</label>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2">
                @include('include.page-size')
            </div>
        @else
            <div class="col-sm-8 col-md-10">
                <h1 class="text-nowrap text-left">Itinerary Home</h1>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2">
                @include('include.page-size')
            </div>
        @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            @if ($data->total() == 0)
                <p>There are no Itineraries to display</p>
            @else
                @if ($data->currentPage() > $data->lastPage() || $data->currentPage() < 1)
                    <p>That page doesn't exist, use the buttons below to navigate</p>
                @else
                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <thead>
                        <tr>
                            <!-- ID -->
                                @include('include.sort', ['column' => 'id', 'display' => 'ID'])
                            <!-- ID -->
                                @include('include.sort', ['column' => 'tour_id', 'display' => 'Tour ID'])
                            <!-- ID -->
                                @include('include.sort', ['column' => 'day_no', 'display' => 'Day No.'])
                            <!-- ID -->
                                @include('include.sort', ['column' => 'hotel_booking', 'display' => 'Hotel Booking'])
                        <!-- ID -->
                            @include('include.sort', ['column' => 'activities', 'display' => 'Activities'])
                        <!-- ID -->
                            @include('include.sort', ['column' => 'meals', 'display' => 'Meals'])
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $row)
                            @if($row->trashed())
                                <tr class="table-danger">
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->tour_id }}</td>
                                    <td>{{ $row->day_no }}</td>
                                    <td>{{ $row->hotel_booking }}</td>
                                    <td>{{ $row->activities }}</td>
                                    <td>{{ $row->meals }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href="{{ url('/itinerary/' . $row->id . '/edit') }}" class="btn btn-light" data-toggle="tooltip" data-placement="left" title="Restore"><i class="material-icons">restore</i></a>
                                            <a href="{{ url('/itinerary/' . $row->id . '/destroy') }}" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Permanently Delete"><i class="material-icons">delete</i></a>
                                            <a href="{{ url('/itinerary/' . $row->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="View"><i class="material-icons">info</i></a>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->tour_id }}</td>
                                    <td>{{ $row->day_no }}</td>
                                    <td>{{ $row->hotel_booking }}</td>
                                    <td>{{ $row->activities }}</td>
                                    <td>{{ $row->meals }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href="{{ url('/itinerary/' . $row->id . '/edit') }}" class="btn btn-warning btn-block" data-toggle="tooltip" data-placement="left" title="Edit"><i class="material-icons">edit</i></a>
                                            <a href="{{ url('/itinerary/' . $row->id . '/destroy') }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="material-icons">delete</i></a>
                                            <a href="{{ url('/itinerary/' . $row->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="View"><i class="material-icons">info</i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @endif
                {{ $data->links() }}
            @endif
        </div>
    </div>
@endsection
