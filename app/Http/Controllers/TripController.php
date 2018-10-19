<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class TripController extends PageController
{

    private $validationRules = [
        'tour_id' => 'required|numeric|min:1|exists:tours,id',
        'vehicle_id' => 'required|numeric|min:1|exists:vehicles,id',
        'departure_date' => 'nullable|date',
        'max_passengers' => 'required|string|min:1|max:6',
        'standard_amount' => 'nullable|numeric|min:0.01',
    ];

    public function index(Request $request) {
        if (!Schema::hasColumn('trips', $request->session()->get('sort_by', 'id'))) {
            $request->session()->put('sort_by', 'id');
        }
        if (Auth::user()->isAdmin()) {
            if ($request->session()->get('show_trashed') === true) {
                if ($this->filter === true) {
                    $data = Trip::withTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                        ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                } else {
                    $data = Trip::withTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                }
            } else {
                if ($this->filter === true) {
                    $data = Trip::withoutTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                        ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                } else {
                    $data = Trip::withoutTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()
                        ->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                }
            }
        } else {
            if ($this->filter === true) {
                $data = Trip::withoutTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                    ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                    ->paginate($request->session()->get('size', 10));
            } else {
                $data = Trip::withoutTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()
                    ->get('direction', 'asc'))
                    ->paginate($request->session()->get('size', 10));
            }
        }
        return view('trip.index', ['data' => $data,
            'size' => $request->session()->get('size', 10),
            'sortBy' => $request->session()->get('sort_by', 'id'),
            'direction' => $request->session()->get('direction', 'asc'),
            'showTrashed' => $request->session()->get('show_trashed', false)]);
    }

    public function show($id) {
        try {
            if (!Auth::user()->isAdmin()) {
                $trip = Trip::findOrFail($id);
            } else {
                $trip = Trip::withTrashed()->findOrFail($id);
            }
            $itineraries = $trip->itineraries()->withTrashed()->get();
            $trips = $trip->trips()->withTrashed()->get();
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        return view('trip.view', ['data' => $trip,
            'itineraries' => $itineraries,
            'trips' => $trips]);
    }

    public function create() {
        return view('trip.create');
    }

    public function destroy($id) {
        try {
            $trip = Trip::withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        if ($trip->trashed()) {
            if (Auth::user()->isAdmin()) {
                $trip->forceDelete();
                Session::flash('success', 'Trip permanently deleted');
                return redirect('trip');
            } else {
                return view('errors.404');
            }
        }
        $trip->delete();
        Session::flash('success', 'Trip deleted');
        return redirect('trip');
    }

    public function store(Request $request) {
        $request->validate($this->validationRules);
        Trip::create($request->except('_token'));
        Session::flash('success', 'Trip added');
        return redirect('trip');
    }

    public function edit($id) {
        try {
            $trip = Trip::withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        if ($trip->trashed()) {
            if (Auth::user()->isAdmin()) {
                $trip->restore();
                Session::flash('success', 'Trip restored');
                return redirect('trip');
            } else {
                return view('errors.404');
            }
        }
        return view('trip.edit')->with(['data' => $trip]);
    }

    public function update(Request $request, $id) {
        $request->validate($this->validationRules);
        try {
            $trip = Trip::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        $trip->update($request->except(['_token', 'id']));
        Session::flash('success', 'Trip edited');
        return redirect('trip');
    }
}
