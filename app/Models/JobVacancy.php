<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    protected $appends = ['status'];

    public function getStatusAttribute()
    {
        // Jika jumlah pelamar sudah memenuhi kebutuhan
        if ($this->applications()->count() >= $this->kebutuhan) {
            return [
                'text' => 'Terpenuhi',
                'class' => 'bg-blue-100 text-blue-800'
            ];
        }
        
        // Jika tanggal sudah lewat
        if (Carbon::parse($this->available_to_date)->endOfDay()->isPast()) {
            return [
                'text' => 'Ditutup',
                'class' => 'bg-red-100 text-red-800'
            ];
        }
        
        // Jika masih aktif
        if ($this->is_active) {
            return [
                'text' => 'Dibuka',
                'class' => 'bg-green-100 text-green-800'
            ];
        }

        return [
            'text' => 'Ditutup',
            'class' => 'bg-red-100 text-red-800'
        ];
    }

    public function position() {
        return $this->belongsTo(position::class, 'id_position');
    }

    public function location() {
        return $this->belongsTo(Location::class, 'id_location');
    }

    public function department() {
        return $this->belongsTo(department::class, 'id_department');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_vacancies_id');
    }

}
