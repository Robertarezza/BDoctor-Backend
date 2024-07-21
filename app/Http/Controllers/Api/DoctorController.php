<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Rating;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $doctorsQuery = Doctor::with(['user', 'specializations', 'ratings']);

        if ($request->specialization_id) {
            $doctorsQuery->whereHas('specializations', function ($query) use ($request) {
                $query->where('specialization_id', $request->specialization_id);
            });
        }

        if ($request->rating_id) {
            $doctorsQuery->whereHas('ratings', function ($query) use ($request) {
                $query->where('rating_id', $request->rating_id);
            });
        }

        $doctors = $doctorsQuery->get()->map(function ($doctor) {
            $doctor->average_rating = $doctor->ratings->avg('rating');
            return $doctor;
        });

        $data = [
            "results" => $doctors
        ];

        return response()->json($data);
    }

    public function show(string $doctor_id)
    {
        $doctor = Doctor::with(['user', 'specializations', 'ratings'])->find($doctor_id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        // Calcola la media dei voti
        $doctor->average_rating = $doctor->ratings->avg('rating');

        $data = [
            'results' => $doctor,
        ];

        return response()->json($data);
    }
}
