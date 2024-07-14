<?php

namespace Database\Seeders;

use App\Models\Performance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerformancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $performances = config('performances');

        foreach ($performances as $performance) {

            $newPerformance = new Performance();
            $newPerformance->title = $performance;
            $newPerformance->save();
        }
    }
}
