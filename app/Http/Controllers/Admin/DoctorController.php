<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorRequest;
use App\Models\Doctor;
use App\Models\Performance;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $doctor = Doctor::where('user_id', $user->id)->first();
        //$userArray = User::all();
        //$doctorsArray = Doctor::all();
        // dd($userArray);
        // dd($doctorsArray);

        return view('admin.doctors.index', compact('user', 'doctor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $doctor = Doctor::where('user_id', $user->id)->first();
        $specializations = Specialization::all();
        $performances = Performance::all();
        return view('admin.doctors.create', compact('user', 'doctor', 'specializations', 'performances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        $doctors = $request->validated();

        // SE LA RICHIESTA PRESENTA IL FILE CON LA CHIAVE PHOTO
        if($request->hasFile('photo')) {

            // CREA IL PATH DELLA FOTO E LA METTE NELLO STORAGE
            $photo_path = Storage::put('photo', $request->photo);

            //ASSOCIA LA FOTO AL PATH CREATO
            $doctors['photo'] = $photo_path;
        }

        // SE LA RICHIESTA PRESENTA IL FILE CON LA CHIAVE CV
        if($request->hasFile('CV')) {
            
            // CREA IL PATH DEL CV E LO METTE NELLO STORAGE
            $cv_path = Storage::put('cv', $request->CV);

            //ASSOCIA IL CV AL PATH CREATO
            $doctors['CV'] = $cv_path;
        }

        $newDoctor = new Doctor();

        //AL NUOVO DOTTORE PRENDO L'USER ID DELL' UTENTE AUTENTICATO
        $newDoctor->user_id = Auth::id();
        $newDoctor->fill($doctors);
        $newDoctor->save();

        //SE LA REQUEST HA SPECIALIZATION
        if ($request->has('specialization')) {
            
            //NELLA COLLECTION SPECIALIZATIONS ATTACCA LE SPECIALIZATION DELLA RICHIESTA
            $newDoctor->specializations()->attach($request->specialization);
        }

        //SE LA REQUEST HA PERFORMANCE
        if ($request->has('performance')) {

            //NELLA COLLECTION PERFORMANCES ATTACCA LE PERFORMANCE DELLA RICHIESTA
            $newDoctor->performances()->attach($request->performance);
        }
        
        // TEST
        // dd($request->all());

        return redirect()->route('admin.doctors.index', ['doctor' => $newDoctor->id]);
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
