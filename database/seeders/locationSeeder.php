<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class locationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::create(['name' => 'Jakarta']);
        Location::create(['name' => 'Surabaya']);
        Location::create(['name' => 'Bali']);
        Location::create(['name' => 'Semarang']);
        Location::create(['name' => 'Tangerang']);
        Location::create(['name' => 'Jayapura']);
        Location::create(['name' => 'Medan']);


    }
}
