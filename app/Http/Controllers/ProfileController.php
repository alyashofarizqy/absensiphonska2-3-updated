<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the profile page.
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }
}
