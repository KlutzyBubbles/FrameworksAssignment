<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function __construct() {
        $this->middleware('auth.message');
    }

    public function index() {
        return view('itinerary.index');
    }

    public function show($id) {
        return view('itinerary.view');
    }

    public function edit($id) {
        return view('itinerary.edit');
    }

    public function create() {
        return view('itinerary.add');
    }

    public function destroy($id) {
        return view('itinerary.delete');
    }

    public function store(Request $request) {
        return view('itinerary.index');
    }

    public function update(Request $request, $id) {
        return view('itinerary.index');
    }
}
