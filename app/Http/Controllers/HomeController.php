<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $doctors = User::where('user_type', 'healthcare')
            ->where('identity', 'doctor')
            ->where('status', 'active')
            ->get(['id', 'name', 'avatar']);
        $pharmacies = User::where('user_type', 'healthcare')
            ->where('identity', 'pharmacies')
            ->latest()
            ->get();
            // dd($doctors);
        return view('home.index', compact(
            'doctors',
            'pharmacies'
        ));
    }
}
