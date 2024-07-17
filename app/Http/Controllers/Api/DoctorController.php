<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
      
    public function index(Request $request)
    {
        $doctorsQuery = Doctor::with(['user', 'specializations']);
        if($request->specialization_id) {
            $doctorsQuery->whereHas('specializations', function ($query) use ($request) {
                $query->where('specialization_id', $request->specialization_id);
            });
        }
        $doctors = $doctorsQuery->get();
        $data = [
            "results"=>$doctors
        ];
    
    return response()->json($data);
    
    }

    public function show(string $doctorId)
    {
        $doctor = Doctor::with(['user', 'specializations'])->where('id', $doctorId)->first();
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }
        $data = [
            'results' => $doctor,
        ];
        return response()->json($data);
    }
}
