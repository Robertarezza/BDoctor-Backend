@extends('layouts.admin')

@section('content')

    {{-- CONTAINER --}}
    <div class="container ms-container-index">

        {{-- DOCTOR INFOS --}}
        <h1 class="text-center mb-5">I tuoi dati</h1>
        @if ($doctor)
            <div class="row">
                {{-- photo --}}
                <div class="col-4">
                    <img class="rounded w-100" src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $user->name }}_img">
                </div>
                <div class="col-8">
                    {{-- name --}}
                    <div class="text-capitalize fs-2 p-2 rounded bg-white">
                        {{ $user->name }} {{ $user->surname }}
                    </div>
                    {{-- phone number --}}
                    <div class="rounded bg-white my-2 p-2">
                        <div class="fw-bold">Numero di telefono:</div>
                        {{ $doctor->phone_number }}
                    </div>
                    {{-- email --}}
                    <div class="rounded bg-white my-2 p-2">
                        <div class="fw-bold">E-mail:</div>
                        {{ $user->email }}
                    </div>
                    {{-- studio address --}}
                    <div class="rounded bg-white my-2 p-2">
                        <div class="fw-bold">Indirizzo:</div>
                        {{ $doctor->studio_address }}
                    </div>
                    {{-- performances --}}
                    <div class="rounded bg-white my-2 p-2">
                        <div class="fw-bold">Prestazioni:</div>
                        @forelse ($doctor->performances as $performance)
                            @if ($performance === $doctor->performances->last())
                                {{ $performance->title }}.
                            @else
                                {{ $performance->title }},
                            @endif
                        @empty
                            nessuna specializzazione selezionata
                        @endforelse
                    </div>
                    {{-- specializations --}}
                    <div class="rounded bg-white my-2 p-2">
                        <div class="fw-bold">Specializzazioni:</div>
                        @forelse ($doctor->specializations as $specialization)
                            @if ($specialization === $doctor->specializations->last())
                                {{ $specialization->title }}.
                            @else
                                {{ $specialization->title }},
                            @endif
                        @empty
                            nessuna specializzazione selezionata
                        @endforelse
                    </div>
                    {{-- cv --}}
                    <div class="rounded bg-white my-2 p-2">
                        <div class="fw-bold">Curriculum Vitae:</div>
                        <a href="{{ asset('storage/' . $doctor->CV) }}" target="_blank" class="text-primary">Guarda il
                            CV</a>
                    </div>

                    {{-- OPEN MODAL --}}
                    <button type="submit" class="ms-openModalDelete btn btn-outline-danger" title="Elimina"><i
                            class="fa-solid fa-trash-can "></i></button>
                    <a href="{{ route('admin.doctors.edit', ['doctor' => $doctor->id]) }}" class="btn btn-outline-warning"
                        title="Modifica">
                        <i class="fa-solid fa-file-pen"></i>
                    </a>
                </div>
            </div>
        @else
            <p class="text-center">Crea il tuo profilo <a href="{{ route('admin.doctors.create') }}">qui</a></p>
        @endif
        {{-- /DOCTOR INFOS --}}


    </div>
    {{-- /CONTAINER --}}

    {{-- MODAL --}}
    @if ($doctor)
        <div class="ms-modal-delete position-absolute start-50 translate-middle-x border p-3 d-none">
            <div class="d-flex justify-content-space-between gap-5">
                <h3>Sei sicuro di voler eliminare il tuo profilo?</h3>
                <button class="ms-closeModalDelete btn btn-secondary"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <hr>
            <form class="d-flex align-center justify-content-end" action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Cancella</button>
            </form>
        </div>
    @endif
@endsection
