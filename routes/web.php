<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JobController;
// Route untuk login dan register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route untuk halaman profil pengguna
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

// Route untuk halaman daftar pekerjaan dan detail pekerjaan
Route::get('/', function () {
    return view('welcome');
});

Route::get('/job-vacancies', [JobController::class, 'index'])->name('job_vacancies.index');
Route::get('/job-vacancies/{id}', [JobController::class, 'show'])->middleware('auth')->name('job_vacancies.show');

// Route untuk mengajukan lamaran
Route::post('/job-vacancies/{id}/apply', [ApplicationController::class, 'apply'])->middleware('auth')->name('job_vacancies.apply');

// Route untuk halaman admin dashboard dengan pengecekan role admin
Route::get('/admin/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return view('admin.dashboard');
    }
    abort(403, 'Unauthorized');
})->middleware('auth')->name('admin.dashboard');

// Route untuk manajemen pekerjaan di admin
Route::middleware('auth')->group(function () {
    Route::get('/admin/job_vacancies', [JobController::class, 'adminIndex'])->name('admin.job_vacancies.index');
    Route::get('/admin/job_vacancies/create', [JobController::class, 'create'])->name('admin.job_vacancies.create');
    Route::post('/admin/job-vacancies', [JobController::class, 'store'])->name('admin.job_vacancies.store');
    Route::get('/admin/job-vacancies/{id}/edit', [JobController::class, 'edit'])->name('admin.job_vacancies.edit');
    Route::put('/admin/job-vacancies/{id}', [JobController::class, 'update'])->name('admin.job_vacancies.update');
    Route::delete('/admin/job-vacancies/{id}', [JobController::class, 'destroy'])->name('admin.job_vacancies.destroy');

    // Route untuk manajemen aplikasi (lamaran)
    Route::get('/admin/applications', [ApplicationController::class, 'index'])->name('admin.applications.index');
    Route::get('/admin/applications/{id}', [ApplicationController::class, 'show'])->name('admin.applications.show');
    Route::delete('/admin/applications/{id}', [ApplicationController::class, 'destroy'])->name('admin.applications.destroy');
});





