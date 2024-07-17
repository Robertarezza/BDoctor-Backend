<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
      
    public function index()
    {
        $doctors = Doctor::with(['user', 'specializations'])->get();
        $data=["results"=>$doctors];
    
    return response()->json($data);
    
    }

    public function show(string $doctorId)
    {
        //dd($doctorId);
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
