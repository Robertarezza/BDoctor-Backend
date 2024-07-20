<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRatingRequest;
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
}
