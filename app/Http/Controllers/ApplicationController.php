<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationStatusUpdate;

class ApplicationController extends Controller
{
    public function apply(Request $request, $id)
    {
        $request->validate([
            'resume_link' => 'nullable|string|max:1000',
        ]);

        $application = new Application();
        $application->user_id = Auth::id();
        $application->job_vacancies_id = $id;
        $application->resume_link = $request->resume_link;
        $application->application_date = now();
        $application->status = "pending";
        $application->save();

        // // Kirimkan notifikasi kepada admin dan kandidat
        // $admin = User::where('role', 'admin')->first();  // Mengambil user dengan role admin
        // $user = User::where('role','user')->first();
        // Notification::send($admin, new ApplicationStatusUpdate($application)); // Notifikasi ke admin
        // // Kirim notifikasi ke kandidat
        // Notification::send($user, new ApplicationStatusUpdate($application));



        return redirect()->route('job_vacancies.index')->with('success', 'Your application has been submitted.');
    }

    public function index()
    {
        $applications = Application::with('user', 'jobVacancy')->get();
        return view('admin.applications.index', compact('applications'));
    }

    public function show($id)
    {
        $application = Application::with('user', 'jobVacancy')->findOrFail($id);
        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $application->status = $request->status;
        $application->save();

        // Kirim notifikasi ke kandidat
        $user = User::find($application->user_id);
        // Notification::send($user, new ApplicationStatusUpdate($application)); // Notifikasi ke kandidat

        return redirect()->route('admin.applications.index')->with('success', 'Application status updated.');
    }
}
