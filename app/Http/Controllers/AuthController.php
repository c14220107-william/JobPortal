<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()->intended("/");
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }
    public function login(Request $request)
        {
            $credentials = $request->only('email', 'password');

            // Cek apakah kredensial valid
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                
                /** @var \App\Models\User $userRole */
                $userRole = Auth::user(); // Pastikan ini adalah instance User

                if ($userRole->role === 'admin') {
                    $userRole->profile_completed = true; // Tandai profile_completed
                    $userRole->save(); // Simpan perubahan
                    return redirect('/admin/dashboard');
                }

                if (!$userRole->profile_completed) {
                    return redirect('/profile-create');
                }

                return redirect('/');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }



    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);
        

    

        $role = 'user';  // Default role adalah 'user'
        if (strpos($request->email, '@hrdcompany.com') !== false) {
            $role = 'admin';  // Jika email mengandung '@hrdcompany.com', set role sebagai 'admin'
        }

        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'profile_completed' => false, // Set role sesuai dengan domain email
        ]);

    
    

        // Arahkan ke halaman login setelah registrasi
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function store(Request $request){
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

    
    // Proses upload gambar profil
    if ($request->hasFile('profile_picture')) {
        $validatedData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    // Proses upload resume
    if ($request->hasFile('resume_link')) {
        $validatedData['resume_link'] = $request->file('resume_link')->store('resumes', 'public');
    }

    // Simpan data ke database
    $user = User::create([
        'nomor_telepon' => $validatedData['nomor_telepon'],
        'tanggal_lahir' => $validatedData['tanggal_lahir'],
        'alamat' => $validatedData['alamat'],
        'total_lama_bekerja' => $validatedData['total_lama_bekerja'],
        'profile_picture' => $validatedData['profile_picture'] ?? null,
        'bio' => $validatedData['bio'] ?? null,
        'resume_link' => $validatedData['resume_link'] ?? null,
    ]);

    return response()->json([
        'message' => 'User berhasil disimpan',
        'user' => $user,
    ]);

    }
    public function Profil($id){
        

    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
