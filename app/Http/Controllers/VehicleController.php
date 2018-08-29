<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct() {
        $this->middleware('auth.message');
    }

    public function index() {
        return view('vehicle.index');
    }

    public function show($id) {
        return view('vehicle.view');
    }

    public function edit($id) {
        return view('vehicle.edit');
    }

    public function create() {
        return view('vehicle.add');
    }

    public function destroy($id) {
        return view('vehicle.delete');
    }

    public function store(Request $request) {
        return view('vehicle.index');
    }

    public function update(Request $request, $id) {
        return view('vehicle.index');
    }
}
