<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $doctors = config('doctors');
        $performance = config('performance');
        foreach ($doctors as $doctor) {
            $newDoctor = new Doctor();
            $newDoctor->fill($doctor);
            $newDoctor->performance = $faker->randomElement($performance);
            $newDoctor->save();
        }
    }
}
