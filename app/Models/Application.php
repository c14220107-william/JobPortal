<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'job_vacancies_id', 
        'cover_letter',
        'application_date','resume_link', 'status', 'resume_link'
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke model JobVacancy
    public function jobVacancy()
    {
        return $this->belongsTo(JobVacancy::class, 'job_vacancies_id');
    }
}
