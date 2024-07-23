<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    public function index()
    {
        // Recupera tutte le sponsorizzazioni disponibili
        $sponsorships = Sponsorship::all();

        // Passa le sponsorizzazioni alla vista
        return view('admin.sponsorships.index', compact('sponsorships'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $user = Auth::user();
    $doctor = Doctor::where('user_id', $user->id)->first();

    if (!$doctor instanceof Doctor) {
        return redirect()->route('admin.sponsorships.index')->with('error', 'Utente non autorizzato');
    }

    $sponsorshipId = $request->input('sponsorship_id');
    $sponsorship = Sponsorship::findOrFail($sponsorshipId);

    $startDate = Carbon::now();
    $newEndDate = $startDate->copy()->addHours($sponsorship->duration);

    // Trova tutte le sponsorizzazioni attive del dottore
    $existingSponsorships = $doctor->sponsorships()
        ->wherePivot('end_date', '>=', $startDate)
        ->get();

    if (!$existingSponsorships->isEmpty()) {
        // Aggiorna la data di fine di tutte le sponsorizzazioni attive
        foreach ($existingSponsorships as $existingSponsorship) {
            $currentEndDate = Carbon::parse($existingSponsorship->pivot->end_date);
            $updatedEndDate = $currentEndDate->copy()->addHours($sponsorship->duration);

            $doctor->sponsorships()->updateExistingPivot($existingSponsorship->id, [
                //'start_date' => $currentEndDate,
                'end_date' => $updatedEndDate,
            ]);
        }
    }

 // Aggiungi la nuova sponsorizzazione
 $doctor->sponsorships()->attach($sponsorshipId, [
    'start_date' => $startDate,
    'end_date' => $newEndDate,
]);

   

    return redirect()->route('admin.sponsorships.index')->with('message', 'Sponsorizzazione attivata con successo!');
}
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
