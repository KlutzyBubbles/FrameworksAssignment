<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct() {
        $this->middleware('auth.message');
    }

    public function index() {
        return view('customer.index');
    }

    public function show($id) {
        return view('customer.view');
    }

    public function edit($id) {
        return view('customer.edit');
    }

    public function create() {
        return view('customer.add');
    }

    public function destroy($id) {
        return view('customer.delete');
    }

    public function store(Request $request) {
        return view('customer.index');
    }

    public function update(Request $request, $id) {
        return view('customer.index');
    }
}
