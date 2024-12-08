<?php

namespace Database\Seeders;

use App\Models\department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class departmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        department::create(['name' => 'IT']);
        department::create(['name' => 'Human Resources']);
        department::create(['name' => 'Finance']);
        department::create(['name' => 'Marketing']);
        department::create(['name' => 'Legal']);
        department::create(['name' => 'Research and Development']);
        department::create(['name' => 'Creative']);
        department::create(['name' => 'Tax']);
        department::create(['name' => 'Sales']);
        department::create(['name' => 'Accounting']);
        department::create(['name' => 'Production']);
        department::create(['name' => 'Purchasing']);
        department::create(['name' => 'Public Relation']);
    }
}
