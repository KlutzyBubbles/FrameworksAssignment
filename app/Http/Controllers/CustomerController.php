<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class CustomerController extends PageController {

    private $validationRules = [
        'first_name' => 'required|string|min:1|max:35',
        'middle_initial' => 'char',
        'last_name' => 'required|string|min:1|max:35',
        'street_no' => 'required|numeric|min:1',
        'street_name' => 'required|string|min:1|max:50',
        'suburb' => 'required|string|min:1|max:35',
        'postcode' => 'required|numeric|min:1000|max:9999',
        'email' => 'required|email',
        'phone' => 'string|min:8|max:10',
        'enabled' => 'required|boolean',
    ];

    public function __construct(Request $request) {
        parent::__construct($request);
        $this->middleware('auth.admin.message', ['except' => ['index', 'enable', 'disable']]);
    }

    public function enable($id) {
        try {
            if (!Auth::user()->isAdmin()) {
                $customer = Customer::findOrFail($id);
            } else {
                $customer = Customer::withTrashed()->findOrFail($id);
            }
            if ($customer->trashed()) {
                Session::flash('error', 'You need to restore the customer before enabling them');
                return redirect('customer');
            }
            if ($customer->enabled) {
                Session::flash('warning', 'That customer is already enabled');
                return redirect('customer');
            }
            $customer->update(['enabled' => true]);
            Session::flash('success', 'That customer has been enabled');
            return redirect('customer');
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
    }

    public function disable($id) {
        try {
            if (!Auth::user()->isAdmin()) {
                $customer = Customer::findOrFail($id);
            } else {
                $customer = Customer::withTrashed()->findOrFail($id);
            }
            if ($customer->trashed()) {
                Session::flash('error', 'You need to restore the customer before disabling them');
                return redirect('customer');
            }
            if (!$customer->enabled) {
                Session::flash('warning', 'That customer is already disabled');
                return redirect('customer');
            }
            $customer->update(['enabled' => false]);
            Session::flash('success', 'That customer has been disabled');
            return redirect('customer');
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
    }

    public function index(Request $request) {
        if (!Schema::hasColumn('customers', $request->session()->get('sort_by', 'id'))) {
            $request->session()->put('sort_by', 'id');
        }
        if (Auth::user()->isAdmin()) {
            if ($request->session()->get('show_trashed') === true) {
                if ($this->filter === true) {
                    $data = Customer::withTrashed()->where($request->session()->get('column'), $request->session()->get
                    ('value'))
                        ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                } else {
                    $data = Customer::withTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                }
            } else {
                if ($this->filter === true) {
                    $data = Customer::withoutTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                        ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                } else {
                    $data = Customer::withoutTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()
                        ->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                }
            }
        } else {
            if ($this->filter === true) {
                $data = Customer::withoutTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                    ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                    ->paginate($request->session()->get('size', 10));
            } else {
                $data = Customer::withoutTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()
                    ->get('direction', 'asc'))
                    ->paginate($request->session()->get('size', 10));
            }
        }
        return view('customer.index', ['data' => $data,
            'size' => $request->session()->get('size', 10),
            'sortBy' => $request->session()->get('sort_by', 'id'),
            'direction' => $request->session()->get('direction', 'asc'),
            'showTrashed' => $request->session()->get('show_trashed', false)]);
    }

    public function show($id) {
        try {
            if (!Auth::user()->isAdmin()) {
                $customer = Customer::findOrFail($id);
            } else {
                $customer = Customer::withTrashed()->findOrFail($id);
            }
            $reviews = $customer->reviews()->withTrashed()->get();
            $bookings = $customer->bookings()->withTrashed()->get();
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        return view('customer.view', ['data' => $customer, 'reviews' => $reviews, 'bookings' => $bookings]);
    }

    public function create() {
        return view('customer.create');
    }

    public function destroy($id) {
        try {
            $customer = Customer::withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        if ($customer->trashed()) {
            if (Auth::user()->isAdmin()) {
                $customer->forceDelete();
                Session::flash('success', 'Customer permanently deleted');
                return redirect('customer');
            } else {
                return view('errors.404');
            }
        }
        $customer->delete();
        Session::flash('success', 'Customer deleted');
        return redirect('customer');
    }

    public function store(Request $request) {
        $request->validate($this->validationRules);
        Customer::create($request->except('_token'));
        Session::flash('success', 'Customer added');
        return redirect('customer');
    }

    public function edit($id) {
        try {
            $customer = Customer::withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        if ($customer->trashed()) {
            if (Auth::user()->isAdmin()) {
                $customer->restore();
                Session::flash('success', 'Customer restored');
                return redirect('customer');
            } else {
                return view('errors.404');
            }
        }
        return view('customer.edit')->with(['data' => $customer]);
    }

    public function update(Request $request, $id) {
        $request->validate($this->validationRules);
        try {
            $customer = Customer::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return view('errors.404');
        }
        $customer->update($request->except(['_token', 'id']));
        Session::flash('success', 'Customer edited');
        return redirect('customer');
    }
}
