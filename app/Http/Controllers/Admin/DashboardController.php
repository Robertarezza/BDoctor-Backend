<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $doctor = Doctor::where('user_id', $user->id)->first();

        // Verifica se il dottore esiste
        if (!$doctor) {
            return redirect()->route('admin.doctors.create');
        }

        // Recupera la sponsorizzazione attiva con la data di fine più lontana
        $activeSponsorship = $doctor->sponsorships()
            ->wherePivot('end_date', '>=', now())
            ->wherePivot('start_date', '<=', now()) // Assicurati di includere anche la data di inizio
            ->orderBy('end_date', 'desc')
            ->first();

        // Altri dati per la vista
        $reviews = Review::where('doctor_id', $user->id)->orderByDesc('created_at')->first();
        $messages = Message::where('doctor_id', $user->id)->orderByDesc('created_at')->first();

        // Recupera le statistiche
        $reviewsCount = Review::where('doctor_id', $doctor->id)->count();
        $messagesCount = Message::where('doctor_id', $doctor->id)->count();
        $ratingsCount = $doctor->ratings()->count();
        $ratingByStars = $doctor->ratings()->select(DB::raw('rating_id, COUNT(*) as count'))->groupBy('rating_id')->orderBy('rating_id', 'asc')->pluck('count', 'rating_id');

        // Divisione dati 
        $ratingLabels = $ratingByStars->keys()->toArray(); // array con rating_id
        $ratingCounts = $ratingByStars->values()->toArray(); // array con i conteggi

        return view('admin.dashboard', [
            'user' => $user,
            'reviews' => $reviews,
            'messages' => $messages,
            'activeSponsorship' => $activeSponsorship,
            'reviewsCount' => $reviewsCount,
            'messagesCount' => $messagesCount,
            'ratingsCount' => $ratingsCount,
            'ratingLabels' => $ratingLabels,
            'ratingCounts' => $ratingCounts,
        ]);
    }
}
