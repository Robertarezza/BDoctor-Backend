<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Message;
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
            return redirect()->route('admin.dashboard')->with('error', 'Dottore non trovato.');
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

        return view('admin.dashboard', [
            'user' => $user,
            'reviews' => $reviews,
            'messages' => $messages,
            'activeSponsorship' => $activeSponsorship
        ]);
    }

}
