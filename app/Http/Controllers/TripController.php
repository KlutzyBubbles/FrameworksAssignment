<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripController extends Controller
{
    public function __construct() {
        $this->middleware('auth.message');
    }

    public function index() {
        return view('trip.index');
    }

    public function show($id) {
        return view('trip.view');
    }

    public function edit($id) {
        return view('trip.edit');
    }

    public function create() {
        return view('trip.add');
    }

    public function destroy($id) {
        return view('trip.delete');
    }

    public function store(Request $request) {
        return view('trip.index');
    }

    public function update(Request $request, $id) {
        return view('trip.index');
    }
}
