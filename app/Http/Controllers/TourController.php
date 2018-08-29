<?php

namespace App\Http\Controllers;

use App\Tour;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TourController extends PageController
{

    private $validationRules = [
        'name' => 'required|string|min:1|max:70',
        'description' => 'required|string|min:1|max:100',
        'duration' => [
            'nullable',
            'regex:/^(\d*[.][\d]|\d*|[.][\d])$/',
            'min:0',
            'numeric',
        ],
        'route_map' => 'nullable|url',
    ];

    public function index(Request $request) {
        if (Auth::user()->isAdmin()) {
            if ($request->session()->get('show_trashed') === true) {
                if ($this->filter === true) {
                    $data = Tour::withTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                        ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                } else {
                    $data = Tour::withTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                }
            } else {
                if ($this->filter === true) {
                    $data = Tour::withoutTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                        ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                } else {
                    $data = Tour::withoutTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()
                        ->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                }
            }
        } else {
            if ($this->filter === true) {
                $data = Tour::withoutTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                    ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                    ->paginate($request->session()->get('size', 10));
            } else {
                $data = Tour::withoutTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()
                    ->get('direction', 'asc'))
                    ->paginate($request->session()->get('size', 10));
            }
        }
        return view('tour.index', ['data' => $data,
                                        'size' => $request->session()->get('size', 10),
                                        'sortBy' => $request->session()->get('sort_by', 'id'),
                                        'direction' => $request->session()->get('direction', 'asc'),
                                        'showTrashed' => $request->session()->get('show_trashed', false)]);
    }

    public function show($id) {
        try {
            $tour = Tour::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        return view('tour.view', ['data' => $tour]);
    }

    public function create() {
        return view('tour.create');
    }

    public function destroy($id) {
        try {
            $tour = Tour::withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }if ($tour->trashed()) {
            if (Auth::user()->isAdmin()) {
                $tour->forceDelete();
                Session::flash('success', 'Tour permanently deleted');
                return redirect('tour');
            } else {
                return view('errors.404');
            }
        }
        if ($tour->trashed()) {
            Session::flash('warning', 'That tour has already been deleted');
            return redirect('tour');
        }
        $tour->delete();
        Session::flash('success', 'Tour deleted');
        return redirect('tour');
    }

    public function store(Request $request) {
        $request->validate($this->validationRules);
        Tour::create($request->except('_token'));
        Session::flash('success', 'Tour added');
        return redirect('tour');
    }

    public function edit($id) {
        try {
            $tour = Tour::withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        if ($tour->trashed()) {
            if (Auth::user()->isAdmin()) {
                $tour->restore();
                Session::flash('success', 'Tour restored');
                return redirect('tour');
            } else {
                return view('errors.404');
            }
        }
        return view('tour.edit')->with(['data' => $tour]);
    }

    public function update(Request $request, $id) {
        $request->validate($this->validationRules);
        try {
            $tour = Tour::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        $tour->update($request->except(['_token', 'id']));
        Session::flash('success', 'Tour edited');
        return redirect('tour');
    }
}
