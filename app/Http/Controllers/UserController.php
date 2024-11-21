<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('profile.index', compact('user'));
    }

    public function editProfile(){
        $user = Auth::user();
        return view('profile.create', compact('user'));

    }
    public function store(Request $request)
        {
                        /**
             * @var \App\Models\User $user
             */
            $user = Auth::user();

            // // Debug 1: Periksa request input sebelum validasi
            // dd($request->all());

            // Validasi input data
            $validatedData = $request->validate([
                'nomor_telepon' => 'required|string|max:15',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required|string|max:255',
                'total_lama_bekerja' => 'required|string|max:50',
                'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'bio' => 'nullable|string',
                'resume_link' => 'nullable|file|mimes:pdf|max:2048',
            ]);

            // // Debug 2: Data setelah validasi
            // dd($validatedData);

            // Proses upload gambar profil
            if ($request->hasFile('profile_picture')) {
                $validatedData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
            }

            // Proses upload resume
            if ($request->hasFile('resume_link')) {
                $validatedData['resume_link'] = $request->file('resume_link')->store('resumes', 'public');
            }

            // // Debug 3: Data sebelum update ke database
            // dd($validatedData);

            // Simpan data ke database
            $user->update([
                'nomor_telepon' => $validatedData['nomor_telepon'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'alamat' => $validatedData['alamat'],
                'total_lama_bekerja' => $validatedData['total_lama_bekerja'],
                'profile_picture' => $validatedData['profile_picture'] ?? null,
                'bio' => $validatedData['bio'] ?? null,
                'resume_link' => $validatedData['resume_link'] ?? null,
                'profile_completed' => true,
            ]);

            return redirect()->route('profile')->with('success', 'Profil berhasil dilengkapi');
        }


}
