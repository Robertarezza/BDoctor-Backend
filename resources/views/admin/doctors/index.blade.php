@extends('layouts.admin')

@section('content')

    {{-- CONTAINER --}}
    <div class="container ms-container-index">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

        {{-- DOCTOR INFOS --}}
        @if ($doctor)
            <div class="row">
                {{-- photo --}}
                <div class="col-sm-12 col-md-4 text-center rounded px-3 py-2 mb-3">
                    <img class="w-100 ms_aspect-ratio rounded mb-3" src="{{ asset('storage/' . $doctor->photo) }}"
                        alt="{{ $user->name }}_img">
                    <div class="d-flex flex-column gap-3">
                        {{-- OPEN MODAL --}}
                        <button type="submit" class="ms-openModalDelete btn btn-danger" title="Elimina"><i
                                class="fa-solid fa-trash-can "></i> Elimina il profilo</button>
                        <a href="{{ route('admin.doctors.edit', ['doctor' => $doctor->id]) }}" class="btn btn-warning"
                            title="Modifica">
                            <i class="fa-solid fa-file-pen"></i>
                            Modifica il profilo
                        </a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 text-white rounded-5">
                    {{-- name --}}
                    <div class="text-capitalize fs-2 p-2 ms-info-bg rounded">
                        {{ $user->name }} {{ $user->surname }}
                    </div>
                    {{-- performances --}}
                    <div class="rounded my-2 p-2 ms-info-bg">
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
                    <div class="rounded my-2 p-2 ms-info-bg">
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
                    {{-- phone number --}}
                    <div class="rounded my-2 p-2 ms-info-bg">
                        <div class="fw-bold">Numero di telefono:</div>
                        {{ $doctor->phone_number }}
                    </div>
                    {{-- email --}}
                    <div class="rounded my-2 p-2 ms-info-bg">
                        <div class="fw-bold">E-mail:</div>
                        {{ $user->email }}
                    </div>
                    {{-- studio address --}}
                    <div class="rounded my-2 p-2 ms-info-bg">
                        <div class="fw-bold">Indirizzo:</div>
                        {{ $doctor->studio_address }}
                    </div>
                    {{-- cv --}}
                    <div class="rounded my-2 p-2 ms-info-bg">
                        <div class="fw-bold">Curriculum Vitae:</div>
                        <a href="{{ asset('storage/' . $doctor->CV) }}" target="_blank" class="text-primary">Guarda il
                            CV</a>
                    </div>
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
                <button class="ms-closeModalDelete btn btn-secondary">Annulla</button>
            </div>
            <hr>
            <form class="d-flex align-center justify-content-end"
                action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Elimina</button>
            </form>
        </div>
    @endif
@endsection
