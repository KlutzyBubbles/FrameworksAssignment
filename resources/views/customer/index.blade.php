@extends('layouts.app')

@section('content')
    <div class="row">
        @if (Auth::user()->isAdmin())
            <div class="col-sm-6 col-md-8">
                <h1 class="text-nowrap text-left">Customer Home</h1>
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
                <h1 class="text-nowrap text-left">Customer Home</h1>
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
                <p>There are no Customers to display</p>
            @else
                @if ($data->currentPage() > $data->lastPage() || $data->currentPage() < 1)
                    <p>That page doesn't exist, use the buttons below to navigate</p>
                @else
                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <thead>
                        <tr>
                            <!-- ID -->
                                @include('include.sort', ['column' => 'id', 'display' => 'ID'])
                            <!-- NAME -->
                                @include('include.sort', ['column' => 'first_name', 'display' => 'First Name'])
                            <!-- DESCRIPTION -->
                                @include('include.sort', ['column' => 'last_name', 'display' => 'Last Name'])
                            <!-- DURATION -->
                                @include('include.sort', ['column' => 'email', 'display' => 'Email'])
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $row)
                            @if ($row->trashed())
                                <tr class="table-danger">
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->first_name }}</td>
                                    <td>{{ $row->last_name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>
                                        @if (Auth::user()->isAdmin())
                                            <div class="btn-group" role="group" aria-label="Actions">
                                                <a href="{{ url('/customer/' . $row->id . '/edit') }}" class="btn btn-light" data-toggle="tooltip" data-placement="left" title="Restore"><i class="material-icons">restore</i></a>
                                                <a href="{{ url('/customer/' . $row->id . '/destroy') }}" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Permanently Delete"><i class="material-icons">delete</i></a>
                                                <a href="{{ url('/customer/' . $row->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="View"><i class="material-icons">info</i></a>
                                            </div>
                                        @else
                                            <div class="btn-group" role="group" aria-label="Actions">
                                                <a href="{{ url('/customer/' . $row->id . '/edit') }}" class="btn btn-light" data-toggle="tooltip" data-placement="left" title="Restore"><i class="material-icons">restore</i></a>
                                                <a href="{{ url('/customer/' . $row->id . '/destroy') }}" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Permanently Delete"><i class="material-icons">delete</i></a>
                                                <a href="{{ url('/customer/' . $row->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="View"><i class="material-icons">info</i></a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @else
                                <tr  {!! $row->enabled ? '' : 'class="table-warning"' !!}>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->first_name }}</td>
                                    <td>{{ $row->last_name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>
                                        @if (Auth::user()->isAdmin())
                                            <div class="btn-group" role="group" aria-label="Actions">
                                                <a href="{{ url('/customer/' . $row->id . '/edit') }}" class="btn btn-warning btn-block" data-toggle="tooltip" data-placement="left" title="Edit"><i class="material-icons">edit</i></a>
                                                <a href="{{ url('/customer/' . $row->id . '/destroy') }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="material-icons">delete</i></a>
                                                <a href="{{ url('/customer/' . $row->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="View"><i class="material-icons">info</i></a>
                                                @if ($row->enabled)
                                                    <a href="{{ url('/customer/disable/' . $row->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Disable"><i class="material-icons">toggle_on</i></a>
                                                @else
                                                    <a href="{{ url('/customer/enable/' . $row->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="right" title="Enable"><i class="material-icons">toggle_off</i></a>
                                                @endif
                                            </div>
                                        @else
                                            @if ($row->enabled)
                                                <a href="{{ url('/customer/disable/' . $row->id) }}" class="btn btn-danger"><i class="material-icons">toggle_on</i> Disable</a>
                                            @else
                                                <a href="{{ url('/customer/enable/' . $row->id) }}" class="btn btn-success"><i class="material-icons">toggle_off</i> Enable</a>
                                            @endif
                                        @endif
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
