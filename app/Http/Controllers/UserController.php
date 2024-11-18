<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('profile', compact('user'));
    }
}
