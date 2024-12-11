<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JobController;
use App\Http\Controllers\NotificationController;

// Route untuk login dan register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route untuk halaman profil pengguna


// Route untuk halaman daftar pekerjaan dan detail pekerjaan
Route::get('/', function () {
    return view('welcome');
});

Route::get('/job-vacancies', [JobController::class, 'index'])->middleware('auth')->name('job_vacancies.index');
Route::get('/job-vacancies/{id}', [JobController::class, 'show'])->middleware('auth')->name('job_vacancies.show');

Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');
Route::get('/profile-create', [UserController::class, 'editProfile'])->name('profile.create');
Route::post('/profile-create', [UserController::class, 'store'])->name('profile.store');






// Route untuk mengajukan lamaran
Route::post('/job-vacancies/{id}/apply', [ApplicationController::class, 'apply'])->middleware('auth')->name('job_vacancies.apply');

// // Route untuk halaman admin dashboard dengan pengecekan role admin
// Route::get('/admin', function () {
//     if (Auth::check() && Auth::user()->role === 'admin') {
//         return view('admin.dashboard');
//     }
//     abort(403, 'Unauthorized');
// })->middleware('auth')->name('admin.dashboard');

// Route untuk manajemen pekerjaan di admin
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/job_vacancies', [JobController::class, 'adminIndex'])->name('admin.job_vacancies.index');
    Route::get('/admin/job_vacancies/detail/{id}', [JobController::class, 'showIndex'])->name('admin.job_vacancies.show');
    Route::get('/admin/job_vacancies/create', [JobController::class, 'create'])->name('admin.job_vacancies.create');
    Route::post('/admin/job-vacancies', [JobController::class, 'store'])->name('admin.job_vacancies.store');
    Route::get('/admin/job-vacancies/{id}/edit', [JobController::class, 'edit'])->name('admin.job_vacancies.edit');
    Route::put('/admin/job-vacancies/{id}', [JobController::class, 'update'])->name('admin.job_vacancies.update');
    Route::delete('/admin/job-vacancies/{id}', [JobController::class, 'destroy'])->name('admin.job_vacancies.destroy');

    // Route untuk manajemen aplikasi (lamaran)
    Route::get('/admin/applications', [ApplicationController::class, 'index'])->name('admin.applications.index');
    Route::get('/admin/applications/{id}', [ApplicationController::class, 'show'])->name('admin.applications.show');
    Route::delete('/admin/applications/{id}', [ApplicationController::class, 'destroy'])->name('admin.applications.destroy');
    Route::put('/admin/applications/{id}/accept', [ApplicationController::class, 'accept'])->name('admin.applications.accept');
    Route::put('/admin/applications/{id}/reject', [ApplicationController::class, 'reject'])->name('admin.applications.reject');


    
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile.index');
    Route::get('/admin/profile/edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
    Route::put('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    

    


    // // Route untuk memperbarui status aplikasi dan mengirimkan notifikasi
    // Route::put('/admin/applications/{id}/status', [ApplicationController::class, 'updateStatus'])->name('admin.applications.updateStatus');
    // Route::post('/admin/applications/{id}/send-notification', [NotificationController::class, 'sendNotification'])->name('admin.applications.sendNotification');

});





