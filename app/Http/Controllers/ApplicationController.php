<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('job_vacancies.index')->with('success', 'Your application has been submitted.');
    }

    public function index()
    {
        // Mengambil semua aplikasi untuk ditampilkan kepada admin
        $applications = Application::with('user', 'jobVacancy')->get();
        
        return view('admin.applications.index', compact('applications'));
    }

     // Detail aplikasi tertentu
     public function show($id)
     {
         // Menampilkan detail aplikasi tertentu
         $application = Application::with('user', 'jobVacancy')->findOrFail($id);
 
         return view('admin.applications.show', compact('application'));
     }
}
