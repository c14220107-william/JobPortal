<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Storage;

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

    public function editProfile()
    {
        $admin = Auth::user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $admin = Auth::user();
        $data = $request->validated();

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($admin->profile_picture) {
                // Storage::disk('public')->delete($admin->profile_picture);
                Storage::disk('s3')->delete($admin->profile_picture);
            }

            // Store new profile picture
            $data['profile_picture'] = $request->file('profile_picture')->store('uploads/profile-pictures','s3', 'public');
        }

        $admin->update($data);

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profil berhasil diperbarui');
    }
}

