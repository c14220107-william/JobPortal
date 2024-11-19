<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'job_vacancies'; // Sesuaikan dengan nama tabel di database

    // Jika Anda memiliki kolom yang bisa diisi massal
    protected $fillable = [
        'title', 'code', 'id_company', 'id_position', 'id_location', 'id_department',
        'requirement', 'description', 'benefit', 'additional_info', 'available_from_date',
        'available_to_date', 'is_active', 'kebutuhan', 'url_jobstreet', 'count'
    ];


    public function position() {
        return $this->belongsTo(Position::class, 'id_position');
    }

    public function location() {
        return $this->belongsTo(Location::class, 'id_location');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'id_department');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_vacancies_id');
    }

}