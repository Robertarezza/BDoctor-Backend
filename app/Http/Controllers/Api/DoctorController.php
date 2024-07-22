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
        $doctorsQuery = Doctor::with(['user', 'specializations', 'ratings', 'reviews']);

        if ($request->specialization_id) {
            $doctorsQuery->whereHas('specializations', function ($query) use ($request) {
                $query->where('specialization_id', $request->specialization_id);
            });
        }

       // Recupera tutti i dottori e calcola la media dei voti, arrotondando per eccesso
       $doctors = $doctorsQuery->get()->map(function ($doctor) {
        // Calcola la media dei voti e arrotonda per eccesso
        $averageRating = $doctor->ratings->avg('rating');
        $doctor->average_rating = $averageRating ? ceil($averageRating) : 0;
        return $doctor;
    });

        // Filtra i dottori in base alla media dei voti
        if ($request->has('average_rating')) {
            $averageRating = $request->input('average_rating');
            $doctors = $doctors->filter(function ($doctor) use ($averageRating) {
                return $doctor->average_rating == $averageRating;
            });
        }
        
        if ($request->review_id) {
            $doctorsQuery->whereHas('reviews', function ($query) use ($request) {
                $query->where('review_id', $request->review_id);
            });
        }

      
        $data = [
           "results" => $doctors->values() 
        ];

        return response()->json($data);
    }

    public function show(string $doctor_id)
    {
        $doctor = Doctor::with(['user', 'specializations', 'ratings', 'reviews'])->find($doctor_id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        // Calcola la media dei voti del dottore e arrotonda per eccesso
        $averageRating = $doctor->ratings->avg('rating');
        $doctor->average_rating = $averageRating ? ceil($averageRating) : 0;

        $data = [
            'results' => $doctor,
        ];

        return response()->json($data);
    }
}
