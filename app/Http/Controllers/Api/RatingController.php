<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRatingRequest;
use App\Models\Doctor;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index() {
        $ratings = Rating::all();
        return response()->json([
            'results' => $ratings,
            'success' => true
        ]);
    }

    public function store(Request $request){

        $profile_vote = Doctor::find($request->doctor_id);
        $profile_vote->ratings()->attach($request->rating_id);

        return response()->json([
            'success' => true,
            'message' => 'Voto salvato con successo',
        ]);
    }
}
