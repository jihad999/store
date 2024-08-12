<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct() {
        $this->middleware(['auth','verified']);
        // ->except('');
    }

    public function index() {
        return view('admin.index');
    }
}
