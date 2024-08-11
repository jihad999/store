<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardeController extends Controller
{
    public function index() {
        // $user = auth()->user();
        // dd($user);
        return view('admin.index');
    }
}
