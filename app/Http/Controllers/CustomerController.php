<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class CustomerController extends PageController {

    private $validationRules = [
        'first_name' => 'required|string|min:1|max:35',
        'middle_initial' => 'string|max:1',
        'last_name' => 'required|string|min:1|max:35',
        'street_no' => 'required|numeric|min:1',
        'street_name' => 'required|string|min:1|max:50',
        'suburb' => 'required|string|min:1|max:35',
        'postcode' => 'required|numeric|min:100|max:9999',
        'email' => 'required|email',
        'phone' => 'string|min:8|max:10',
        'enabled' => '',
    ];

    public function __construct(Request $request) {
        Log::info('construct', ['controller' => 'customer']);
        parent::__construct($request);
        $this->middleware('auth.admin.message', ['except' => ['index', 'enable', 'disable']]);
    }

    public function enable($id) {
        Log::info('enable', ['controller' => 'customer', 'data' => $id]);
        try {
            if (!Auth::user()->isAdmin()) {
                Log::debug('user is not admin', ['controller' => 'customer']);
                $customer = Customer::findOrFail($id);
            } else {
                Log::debug('user is admin', ['controller' => 'customer']);
                $customer = Customer::withTrashed()->findOrFail($id);
            }
            Log::debug('customer found', ['controller' => 'customer', 'data' => $customer]);
            if ($customer->trashed()) {
                Log::debug('customer is trashed', ['controller' => 'customer']);
                Session::flash('error', 'You need to restore the customer before enabling them');
                return redirect('customer');
            }
            Log::debug('customer is not trashed', ['controller' => 'customer']);
            if ($customer->enabled) {
                Log::debug('customer is enabled', ['controller' => 'customer']);
                Session::flash('warning', 'That customer is already enabled');
                return redirect('customer');
            }
            Log::debug('customer is not enabled', ['controller' => 'customer']);
            $customer->update(['enabled' => true]);
            Session::flash('success', 'That customer has been enabled');
            return redirect('customer');
        } catch (ModelNotFoundException $e) {
            Log::warning('customer not found', ['controller' => 'customer', 'data' => $id]);
            return view('errors.404');
        }
    }

    public function disable($id) {
        Log::info('disable', ['controller' => 'customer', 'data' => $id]);
        try {
            if (!Auth::user()->isAdmin()) {
                Log::debug('user is not admin', ['controller' => 'customer']);
                $customer = Customer::findOrFail($id);
            } else {
                Log::debug('user is admin', ['controller' => 'customer']);
                $customer = Customer::withTrashed()->findOrFail($id);
            }
            Log::debug('customer found', ['controller' => 'customer', 'data' => $customer]);
            if ($customer->trashed()) {
                Log::debug('customer is trashed', ['controller' => 'customer']);
                Session::flash('error', 'You need to restore the customer before disabling them');
                return redirect('customer');
            }
            Log::debug('customer is not trashed', ['controller' => 'customer']);
            if (!$customer->enabled) {
                Log::debug('customer is not enabled', ['controller' => 'customer']);
                Session::flash('warning', 'That customer is already disabled');
                return redirect('customer');
            }
            Log::debug('customer is enabled', ['controller' => 'customer']);
            $customer->update(['enabled' => false]);
            Session::flash('success', 'That customer has been disabled');
            return redirect('customer');
        } catch (ModelNotFoundException $e) {
            Log::warning('customer not found', ['controller' => 'customer', 'data' => $id]);
            return view('errors.404');
        }
    }

    public function index(Request $request) {
        Log::info('index', ['controller' => 'customer']);
        if (!Schema::hasColumn('customers', $request->session()->get('sort_by', 'id'))) {
            Log::debug('invalid sort by', ['controller' => 'customer', 'data' => $request->session()->get('sort_by', 'id')]);
            $request->session()->put('sort_by', 'id');
        }
        if (Auth::user()->isAdmin()) {
            Log::debug('user is admin', ['controller' => 'customer']);
            if ($request->session()->get('show_trashed') === true) {
                Log::debug('with trashed', ['controller' => 'customer']);
                if ($this->filter === true) {
                    Log::debug('filtered', ['controller' => 'customer', 'column' => $request->session()->get('column'), 'value' => $request->session()->get('value')]);
                    $data = Customer::withTrashed()->where($request->session()->get('column'), $request->session()->get
                    ('value'))
                        ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                } else {
                    Log::debug('not filtered', ['controller' => 'customer']);
                    $data = Customer::withTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                }
            } else {
                Log::debug('without trashed', ['controller' => 'customer']);
                if ($this->filter === true) {
                    Log::debug('filtered', ['controller' => 'customer', 'column' => $request->session()->get('column'), 'value' => $request->session()->get('value')]);
                    $data = Customer::withoutTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                        ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                } else {
                    Log::debug('not filtered', ['controller' => 'customer']);
                    $data = Customer::withoutTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()
                        ->get('direction', 'asc'))
                        ->paginate($request->session()->get('size', 10));
                }
            }
        } else {
            Log::debug('user is not admin', ['controller' => 'customer']);
            if ($this->filter === true) {
                Log::debug('filtered', ['controller' => 'customer', 'column' => $request->session()->get('column'), 'value' => $request->session()->get('value')]);
                $data = Customer::withoutTrashed()->where($request->session()->get('column'), $request->session()->get('value'))
                    ->orderBy($request->session()->get('sort_by', 'id'), $request->session()->get('direction', 'asc'))
                    ->paginate($request->session()->get('size', 10));
            } else {
                Log::debug('not filtered', ['controller' => 'customer']);
                $data = Customer::withoutTrashed()->orderBy($request->session()->get('sort_by', 'id'), $request->session()
                    ->get('direction', 'asc'))
                    ->paginate($request->session()->get('size', 10));
            }
        }
        Log::info('returned values', ['controller' => 'customer', 'size' => $request->session()->get('size', 10),
            'sortBy' => $request->session()->get('sort_by', 'id'),
            'direction' => $request->session()->get('direction', 'asc'),
            'showTrashed' => $request->session()->get('show_trashed', false)]);
        return view('customer.index', ['data' => $data,
            'size' => $request->session()->get('size', 10),
            'sortBy' => $request->session()->get('sort_by', 'id'),
            'direction' => $request->session()->get('direction', 'asc'),
            'showTrashed' => $request->session()->get('show_trashed', false)]);
    }

    public function show($id) {
        Log::info('show', ['controller' => 'customer', 'data' => $id]);
        // No isAdmin() required due to this page only accessible by admins
        try {
            $customer = Customer::withTrashed()->findOrFail($id);
            Log::debug('customer found', ['controller' => 'customer', 'data' => $customer]);
            $reviews = $customer->reviews()->get();
            Log::debug('reviews attached', ['controller' => 'customer', 'data' => $reviews]);
            $bookings = $customer->bookings()->get();
            Log::debug('bookings attached', ['controller' => 'customer', 'data' => $bookings]);
        } catch (ModelNotFoundException $e) {
            Log::warning('customer not found', ['controller' => 'customer', 'data' => $id]);
            return view('errors.404');
        }
        return view('customer.view', ['data' => $customer, 'reviews' => $reviews, 'bookings' => $bookings]);
    }

    public function create() {
        Log::info('create', ['controller' => 'customer']);
        return view('customer.create');
    }

    public function destroy($id) {
        Log::info('destroy', ['controller' => 'customer', 'data' => $id]);
        try {
            $customer = Customer::withTrashed()->findOrFail($id);
            Log::debug('customer found', ['controller' => 'customer', 'data' => $customer]);
        } catch (ModelNotFoundException $e) {
            Log::warning('customer not found', ['controller' => 'customer', 'data' => $id]);
            return view('errors.404');
        }
        if ($customer->trashed()) {
            Log::debug('customer is trashed', ['controller' => 'customer']);
            if (Auth::user()->isAdmin()) {
                Log::debug('user is admin', ['controller' => 'customer']);
                $customer->forceDelete();
                Session::flash('success', 'Customer permanently deleted');
                return redirect('customer');
            } else {
                Log::debug('user is not admin', ['controller' => 'customer']);
                return view('errors.404');
            }
        }
        Log::debug('customer is not trashed', ['controller' => 'customer']);
        $customer->enabled = false;
        $customer->update();
        $customer->delete();
        Session::flash('success', 'Customer deleted');
        return redirect('customer');
    }

    public function store(Request $request) {
        Log::info('store', ['controller' => 'customer']);
        Log::debug('validation rules', ['controller' => 'customer', 'data' => $this->validationRules]);
        $request->validate($this->validationRules);
        $data = $request->except(['_token']);
        Log::debug('unformatted data', ['controller' => 'customer', 'data' => $data]);
        $data['enabled'] = isset($data['enabled']) ? $data['enabled'] === 'on' : false;
        $data['middle_initial'] = strtoupper($data['middle_initial']);
        Log::debug('formatted data', ['controller' => 'customer', 'data' => $data]);
        Customer::create($data);
        Session::flash('success', 'Customer added');
        return redirect('customer');
    }

    public function edit($id) {
        Log::info('edit', ['controller' => 'customer', 'data' => $id]);
        try {
            $customer = Customer::withTrashed()->findOrFail($id);
            Log::debug('customer found', ['controller' => 'customer', 'data' => $customer]);
        } catch (ModelNotFoundException $e) {
            Log::warning('customer not found', ['controller' => 'customer', 'data' => $id]);
            return view('errors.404');
        }
        if ($customer->trashed()) {
            Log::debug('customer is trashed', ['controller' => 'customer']);
            if (Auth::user()->isAdmin()) {
                Log::debug('user is admin', ['controller' => 'customer']);
                $customer->restore();
                Session::flash('success', 'Customer restored');
                return redirect('customer');
            } else {
                Log::debug('user is not admin', ['controller' => 'customer']);
                return view('errors.404');
            }
        }
        Log::debug('customer is not trashed', ['controller' => 'customer']);
        return view('customer.edit')->with(['data' => $customer]);
    }

    public function update(Request $request, $id) {
        Log::info('update', ['controller' => 'customer', 'data' => $id]);
        Log::debug('validation rules', ['controller' => 'customer', 'data' => $this->validationRules]);
        $request->validate($this->validationRules);
        try {
            $customer = Customer::findOrFail($id);
            Log::debug('customer found', ['controller' => 'customer', 'data' => $customer]);
        } catch (ModelNotFoundException $e) {
            Log::warning('customer not found', ['controller' => 'customer', 'data' => $id]);
            return view('errors.404');
        }
        $data = $request->except(['_token', 'id']);
        Log::debug('unformatted data', ['controller' => 'customer', 'data' => $data]);
        $data['enabled'] = isset($data['enabled']) ? $data['enabled'] === 'on' : false;
        $data['middle_initial'] = strtoupper($data['middle_initial']);
        Log::debug('formatted data', ['controller' => 'customer', 'data' => $data]);
        $customer->update($data);
        Session::flash('success', 'Customer edited');
        return redirect('customer');
    }
}
