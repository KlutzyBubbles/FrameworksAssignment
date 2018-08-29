<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct() {
        $this->middleware('auth.message');
    }

    public function index() {
        return view('review.index');
    }

    public function show($id) {
        return view('review.view');
    }

    public function edit($id) {
        return view('review.edit');
    }

    public function create() {
        return view('review.add');
    }

    public function destroy($id) {
        return view('review.delete');
    }

    public function store(Request $request) {
        return view('review.index');
    }

    public function update(Request $request, $id) {
        return view('review.index');
    }
}
