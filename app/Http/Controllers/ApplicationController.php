<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ApplicationStatusUpdate;
use Aws\Sns\SnsClient;


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
        $application->apply_status = true;
        $application->save();



        // Kirim notifikasi menggunakan SNS
        $jobVacancy = JobVacancy::findOrFail($id);
        $adminEmails = User::where('role', 'admin')->pluck('email')->toArray(); // Dapatkan email admin
        
        $snsClient = new SnsClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
                'token' => env('AWS_SESSION_TOKEN')
            ],
        ]);

        $message = sprintf(
            "New job application received.\n\nJob Title: %s\nUser: %s\nDate: %s\nCheck Now at http://3.88.74.22/",
            $jobVacancy->title,
            Auth::user()->name,
            now()->toDateTimeString()
        );

        foreach ($adminEmails as $email) {
            $snsClient->publish([
                'TopicArn' => env('AWS_SNS_TOPIC_ARN'),
                'Message' => $message,
                'Subject' => 'New Job Application',
            ]);
        }

    



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
