<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function __construct() {
        $this->middleware('auth.admin.message');
    }

    public function index() {
        return view('staff.index');
    }

    public function show($id) {
        return view('staff.view');
    }

    public function edit($id) {
        return view('staff.edit');
    }

    public function create() {
        return view('staff.add');
    }

    public function destroy($id) {
        return view('staff.delete');
    }

    public function store(Request $request) {
        return view('staff.index');
    }

    public function update(Request $request, $id) {
        return view('staff.index');
    }
}
