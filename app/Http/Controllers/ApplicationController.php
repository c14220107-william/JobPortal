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

        // Simpan aplikasi
        $application = new Application();
        $application->user_id = Auth::id();
        $application->job_vacancies_id = $id;
        $application->resume_link = $request->resume_link;
        $application->application_date = now();
        $application->status = "on_process";
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
            // Menambahkan email admin ke subscription SNS jika belum ada
            $this->addEmailToSubscription($snsClient, $email);
        }

        return redirect()->route('job_vacancies.index')->with('success', 'Your application has been submitted.');
    }

    /**
     * Menambahkan email ke subscription SNS jika belum ada
     *
     * @param \Aws\Sns\SnsClient $snsClient
     * @param string $email
     */
    private function addEmailToSubscription(SnsClient $snsClient, string $email)
    {
        try {
            // Cek apakah email sudah terdaftar sebagai subscription
            $result = $snsClient->listSubscriptionsByTopic([
                'TopicArn' => env('AWS_SNS_TOPIC_ARN'),
            ]);


            $existingSubscriptions = $result['Subscriptions'];
            $emailExists = false;

            // Periksa apakah email sudah terdaftar
            foreach ($existingSubscriptions as $subscription) {
                if ($subscription['Endpoint'] === $email) {
                    $emailExists = true;
                    break;
                }
            }

            // Jika email belum terdaftar, tambahkan sebagai subscription
            if (!$emailExists) {
                $snsClient->subscribe([
                    'TopicArn' => env('AWS_SNS_TOPIC_ARN'),
                    'Protocol' => 'email', // Menggunakan email sebagai protocol
                    'Endpoint' => $email, // Email yang akan ditambahkan
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Failed to add email to SNS subscription: ' . $e->getMessage());
        }
    }

    /**
     * Menambahkan email ke subscription SNS jika belum ada
     *
     * @param \Aws\Sns\SnsClient $snsClient
     * @param string $email
     */
    private function addEmailToSubscription2(SnsClient $snsClient, string $email)
    {
        try {
            // Cek apakah email sudah terdaftar sebagai subscription
            $result = $snsClient->listSubscriptionsByTopic([
                'TopicArn' => env('AWS_SNS_TOPIC_ARN'),
            ]);


            $existingSubscriptions = $result['Subscriptions'];
            $emailExists = false;

            // Periksa apakah email sudah terdaftar
            foreach ($existingSubscriptions as $subscription) {
                if ($subscription['Endpoint'] === $email) {
                    $emailExists = true;
                    break;
                }
            }

            // Jika email belum terdaftar, tambahkan sebagai subscription
            if (!$emailExists) {
                $snsClient->subscribe([
                    'TopicArn' => env('AWS_SNS_TOPIC_ARN'),
                    'Protocol' => 'email', // Menggunakan email sebagai protocol
                    'Endpoint' => $email, // Email yang akan ditambahkan
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Failed to add email to SNS subscription: ' . $e->getMessage());
        }
    }

    public function index(Request $request)
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



        return redirect()->route('admin.applications.index')->with('success', 'Application status updated.');
    }


    public function myApplications(Request $request)
    {
        // Ambil aplikasi pekerjaan berdasarkan user yang sedang login
        $query = Application::with('jobVacancy') // Ambil relasi jobVacancy
            ->where('user_id', Auth::id());

        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->orderBy('application_date', 'desc')->get();

        // Kirim data ke view
        return view('applications.myApplications', compact('applications'));
    }

    public function accept(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $application->status = "Accepted";
        $application->save();

        try {
            // Kirim notifikasi menggunakan SNS
            $jobVacancy = $application->jobVacancy;
            $userEmails = User::where('role', 'user')->pluck('email')->toArray();

            $snsClient = new SnsClient([
                'version' => 'latest',
                'region'  => 'us-east-1',
                'credentials' => [
                    'key'    => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                    'token'  => env('AWS_SESSION_TOKEN')
                ]
            ]);

            $message = sprintf(
                "Congratulation You Are Accepted to this Company.\n\nJob Title: %s\nCheck Now at http://3.88.74.22/",
                $jobVacancy->title,
            );

            foreach ($userEmails as $email) {
                $snsClient->publish([
                    'TopicArn' => env('AWS_SNS_TOPIC_ARN'),
                    'Message' => $message,
                    'Subject' => 'Announcement',
                ]);
                // Menambahkan email admin ke subscription SNS jika belum ada
                $this->addEmailToSubscription2($snsClient, $email);
            }
        } catch (\Exception $e) {
            // Log the error but don't stop the process
            \Log::error('SNS Notification failed: ' . $e->getMessage());
        }

        return redirect()->route('admin.applications.index')->with('success', 'Aplikasi berhasil diterima');
    }

    public function reject(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $application->status = "Rejected";
        $application->save();

        try {
            // Kirim notifikasi menggunakan SNS
            $jobVacancy = $application->jobVacancy;
            $userEmails = User::where('role', 'user')->pluck('email')->toArray();

            $snsClient = new SnsClient([
                'version' => 'latest',
                'region'  => 'us-east-1',
                'credentials' => [
                    'key'    => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                    'token'  => env('AWS_SESSION_TOKEN')
                ]
            ]);

            $message = sprintf(
                "Sorry You Are Rejected in This Company.\n\nJob Title: %s\nCheck Now at http://3.88.74.22/",
                $jobVacancy->title,
            );

            foreach ($userEmails as $email) {
                $snsClient->publish([
                    'TopicArn' => env('AWS_SNS_TOPIC_ARN'),
                    'Message' => $message,
                    'Subject' => 'Announcement',
                ]);
                // Menambahkan email admin ke subscription SNS jika belum ada
                $this->addEmailToSubscription2($snsClient, $email);
            }
        } catch (\Exception $e) {
            // Log the error but don't stop the process
            \Log::error('SNS Notification failed: ' . $e->getMessage());
        }
    
        return redirect()->route('admin.applications.index')->with('success', 'Aplikasi berhasil ditolak');
    }



}
