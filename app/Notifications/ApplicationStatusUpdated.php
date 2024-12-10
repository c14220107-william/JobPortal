<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusUpdated extends Notification
{
    use Queueable;

    protected $application;

    // Konstruktor untuk menerima objek Application
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    // Mengatur saluran notifikasi (contoh: email)
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Mengatur konten email yang dikirim
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Application Status Update')
                    ->line('Your application for the position "' . $this->application->jobVacancy->title . '" has been updated.')
                    ->line('Status: ' . $this->application->status)
                    ->action('View Application', url('/applications/' . $this->application->id))
                    ->line('Thank you for using our application platform!');
    }

    // Bisa juga mengirimkan notifikasi melalui database atau saluran lainnya jika diperlukan
    public function toArray($notifiable)
    {
        return [
            'application_id' => $this->application->id,
            'status' => $this->application->status,
            'job_title' => $this->application->jobVacancy->title,
        ];
    }
}
