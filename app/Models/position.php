<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class position extends Model
{
    protected $table = 'positions';

    protected $fillable = [
        'title',
        'description'
    ];

    public function jobVacancies()
    {
        return $this->hasMany(JobVacancy::class, 'id_position');
    }
}
