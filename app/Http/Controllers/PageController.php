<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public $filter = false;

    public function __construct(Request $request) {
        $this->middleware('web');
        $this->middleware('auth.message');
        if ($request->has('size')) {
            $temp = $request->get('size');
            if (is_numeric($temp)) {
                $request->session()->put('size', $temp > 500 ? 500 : $temp < 1 ? 1 : $temp);
            } else if (!$request->session()->has('size')) {
                $request->session()->put('size', 10);
            }
        }
        if ($request->has('column')) {
            $temp = $request->get('column');
            if ($temp != null && $temp != '') {
                $request->session()->put('column', $temp);
                $this->filter = true;
            } else if ($request->session()->has('column')) {
                $request->session()->forget('column');
            }
        }
        if ($request->has('value')) {
            $temp = $request->get('value');
            if ($temp != null && $temp != '') {
                $request->session()->put('value', $temp);
                $this->filter = true;
            } else if ($request->session()->has('value')) {
                $request->session()->forget('value');
            }
        }
        if (!$request->session()->has('column') || !$request->session()->has('value'))
            $this->filter = false;
        if ($request->has('sort_by')) {
            $temp = $request->get('sort_by');
            if ($temp != null && $temp != '') {
                $request->session()->forget('sort_by');
                $request->session()->put('sort_by', $temp);
            } else if (!$request->session()->has('sort_by')) {
                $request->session()->put('sort_by', 'id');
            }
        }
        if ($request->has('direction')) {
            $temp = $request->get('direction');
            if ($temp != null && $temp != '') {
                $request->session()->forget('direction');
                if (strtolower($temp) == 'desc') {
                    $request->session()->put('direction', $temp);
                } else {
                    $request->session()->put('direction', 'asc');
                }
            } else if (!$request->session()->has('direction')) {
                $request->session()->put('direction', 'asc');
            }
        }
        if ($request->has('show_trashed')) {
            $temp = $request->get('show_trashed');
            if ($temp != null && $temp != '') {
                $request->session()->forget('show_trashed');
                if (strtolower($temp) == 'true') {
                    $request->session()->put('show_trashed', true);
                } else {
                    $request->session()->put('show_trashed', false);
                }
            } else if (!$request->session()->has('show_trashed')) {
                $request->session()->put('direction', true);
            }
        }
    }
}
