<?php

namespace Database\Seeders;

use App\Models\position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class positionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        position::create(['title' => 'Developer']);
        position::create(['title' => 'Designer']);
        position::create(['title' => 'Project Manager']);
    }
}
