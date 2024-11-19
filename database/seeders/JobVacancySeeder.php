<?php

// database/seeders/JobVacancySeeder.php
namespace Database\Seeders;

use App\Models\department;
use Illuminate\Database\Seeder;
use App\Models\JobVacancy;
use App\Models\Location;
use App\Models\position;

class JobVacancySeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan ID untuk Position, Location, dan Department
        $position = position::first();
        $location = Location::first();
        $department = department::first();

        

        for ($i =0;$i<5;$i++){
            JobVacancy::create([
                'title' => 'Software Engineer',
                'code' => 'SE123',
                'id_position' => $position->id, // ID position yang ada di database
                'id_location' => $location->id, // ID location yang ada di database
                'id_department' => $department->id, // ID department yang ada di database
                'requirement' => 'Bachelor\'s degree in Computer Science or related field.',
                'description' => 'Develop and maintain software applications.',
                'benefit' => 'Health insurance, paid time off.',
                'additional_info' => 'Remote work available.',
                'available_from_date' => now()->toDateString(),
                'available_to_date' => now()->addMonths(3)->toDateString(),
                'is_active' => true,
                'created_date' => now(),
                'updated_date' => now(),
                'kebutuhan' => 3,
                'url_jobstreet' => 'https://jobstreet.com/software-engineer',
                'count' => 0,
            ]);

        }
        
    }
}
