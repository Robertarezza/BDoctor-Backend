@extends('layouts.admin')

@section('content')

    {{-- CONTAINER --}}
    <div class="container ms-container-index">

        {{-- DOCTOR INFOS --}}
        <h1 class="text-center">I tuoi dati</h1>
        @if ($doctor)
            {{-- PHOTO --}}
            <img class="doctor-photo" src=" {{ asset('storage/' . $doctor->photo) }}" alt="">

            {{-- OPEN MODAL --}}
            <button type="submit" class="ms-openModalDelete btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>

        @else
            <p>No doctor profile found for the logged in user.</p>
        @endif
        {{-- /DOCTOR INFOS --}}


    </div>
    {{-- /CONTAINER --}}

    {{-- MODAL --}}
    <div class="ms-modal-delete position-absolute top-50 start-50 translate-middle border p-3 d-none">
        <div class="d-flex justify-content-space-between gap-5">
            <h3>Sei sicuro di voler eliminare il tuo profilo?</h3>
            <button class="ms-closeModalDelete btn btn-secondary"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <hr>
        <form action="{{ route('admin.doctors.destroy',$doctor->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Cancella</button>
        </form>
    </div>
@endsection
