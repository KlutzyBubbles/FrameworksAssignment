<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct() {
        $this->middleware('auth.message');
    }

    public function index() {
        return view('booking.index');
    }

    public function show($id) {
        return view('booking.view');
    }

    public function edit($id) {
        return view('booking.edit');
    }

    public function create() {
        return view('booking.add');
    }

    public function destroy($id) {
        return view('booking.delete');
    }

    public function store(Request $request) {
        return view('booking.index');
    }

    public function update(Request $request, $id) {
        return view('booking.index');
    }
}
