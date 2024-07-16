<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
      
    public function index()
    {
        $doctors=Doctor::with(['user', 'specializations'])->get();
        $data=["results"=>$doctors];
    
    return response()->json($data);
    
    }
}
