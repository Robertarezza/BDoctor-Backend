<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = config('doctors');
        foreach ($doctors as $doctor) {
            $newDoctor = new Doctor();
            $newDoctor->fill($doctor);
            $newDoctor->save();
        }
    }
}
