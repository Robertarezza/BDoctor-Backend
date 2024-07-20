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
        if($request->specialization_id) {
            $doctorsQuery->whereHas('specializations', function ($query) use ($request) {
                $query->where('specialization_id', $request->specialization_id);
            });
        }
        if($request->rating_id) {
            $doctorsQuery->whereHas('ratings', function ($query) use ($request) {
                $query->where('rating_id', $request->rating_id);
            });
        }
        $doctors = $doctorsQuery->get();
        $data = [
            "results"=>$doctors
        ];
    
    return response()->json($data);
    
    }

    public function show(string $doctor_id)
    {
        //dd($doctorId);
        $doctor = Doctor::with(['user', 'specializations'])->where('id', $doctor_id)->first();
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }
        $data = [
            'results' => $doctor,
        ];
        return response()->json($data);
    }
}
