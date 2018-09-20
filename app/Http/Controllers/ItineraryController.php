<?php

namespace App\Http\Controllers;

use App\Itinerary;
use App\Tour;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class ItineraryController extends PageController {

    private $validationRules = [
        'tour_id' => 'required|numeric|min:1|exists:tours,id',
        'day_no' => 'required|numeric|min:1',
        'hotel_booking' => 'required|string|min:1|max:6',
        'activities' => 'nullable|string|min:1|max:150',
        'meals' => 'nullable|string|min:1|max:150',
    ];

    public function index(Request $request) {
        if (!Schema::hasColumn('itineraries', $request->session()->get('sort_by', 'id'))) {
            $request->session()->put('sort_by', 'id');
        }
        if (Auth::user()->isAdmin()) {
            if ($request->session()->get('show_trashed') === true) {
                if ($this->filter === true) {
                    $data = Itinerary::withTrashed()->where($request->session()->get('column'), $request->session()->get
                    ('value'))
                        ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                } else {
                    $data = Itinerary::withTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                }
            } else {
                if ($this->filter === true) {
                    $data = Itinerary::withoutTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                        ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                } else {
                    $data = Itinerary::withoutTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()
                        ->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                }
            }
        } else {
            if ($this->filter === true) {
                $data = Itinerary::withoutTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                    ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                    ->paginate($request->session()->get('size', 10));
            } else {
                $data = Itinerary::withoutTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()
                    ->get('direction', 'asc'))
                    ->paginate($request->session()->get('size', 10));
            }
        }
        return view('itinerary.index', ['data' => $data,
            'size' => $request->session()->get('size', 10),
            'sortBy' => $request->session()->get('sort_by', 'id'),
            'direction' => $request->session()->get('direction', 'asc'),
            'showTrashed' => $request->session()->get('show_trashed', false)]);
    }

    public function show($id) {
        try {
            if (!Auth::user()->isAdmin()) {
                $itinerary = Itinerary::findOrFail($id);
            } else {
                $itinerary = Itinerary::withTrashed()->findOrFail($id);
            }
            $tour = Tour::findOrFail($itinerary->tour_id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        return view('itinerary.view', ['data' => $itinerary, 'tour' => $tour]);
    }

    public function create() {
        $tours = Tour::all();
        if ($tours->isEmpty()) {
            Session::flash('error', 'Please create a tour before creating an itinerary');
            return redirect('itinerary');
        }
        return view('itinerary.create', ['tours' => $tours]);
    }

    public function destroy($id) {
        try {
            $itinerary = Itinerary::withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        if ($itinerary->trashed()) {
            if (Auth::user()->isAdmin()) {
                $itinerary->forceDelete();
                Session::flash('success', 'Itinerary permanently deleted');
                return redirect('itinerary');
            } else {
                return view('errors.404');
            }
        }
        $itinerary->delete();
        Session::flash('success', 'Itinerary deleted');
        return redirect('itinerary');
    }

    public function store(Request $request) {
        $request->validate($this->validationRules);
        Itinerary::create($request->except('_token'));
        Session::flash('success', 'Itinerary added');
        return redirect('itinerary');
    }

    public function edit($id) {
        try {
            $itinerary = Itinerary::withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        if ($itinerary->trashed()) {
            if (Auth::user()->isAdmin()) {
                $itinerary->restore();
                Session::flash('success', 'Itinerary restored');
                return redirect('itinerary');
            } else {
                return view('errors.404');
            }
        }
        $tours = Tour::all();
        if ($tours->isEmpty()) {
            Session::flash('error', 'Please create a tour before editing an itinerary');
            return redirect('itinerary');
        }
        return view('itinerary.edit')->with(['data' => $itinerary, 'tours' => $tours]);
    }

    public function update(Request $request, $id) {
        $request->validate($this->validationRules);
        try {
            $itinerary = Itinerary::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        $itinerary->update($request->except(['_token', 'id']));
        Session::flash('success', 'Itinerary edited');
        return redirect('itinerary');
    }
}
