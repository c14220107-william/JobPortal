<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized'); // Hentikan jika bukan admin
        }

        return view('admin.dashboard'); // Tampilkan dashboard jika admin
    }

    public function profile()
    {
        $admin = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('admin.profile.index', compact('admin'));
    }

}

