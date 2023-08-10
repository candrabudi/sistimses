<?php

namespace Database\Seeders;

use App\Models\PopulationData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeopleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PopulationData::factory()
            ->count(10000) // Generate 10 fake records
            ->create();
    }
}
