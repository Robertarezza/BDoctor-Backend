@extends('layouts.admin')

@section('content')

    {{-- CONTAINER --}}
    <div class="container ms-container-index">

        {{-- DOCTOR INFOS --}}
        <h1 class="text-center">I tuoi dati</h1>
        @if ($doctor)
            {{-- PHOTO --}}
            <img class="doctor-photo" src=" {{ asset('storage/' . $doctor->photo) }}" alt="">

            {{-- TABLE --}}
            <table class="table">


                {{-- <tr>
                    <th>ID</th>
                    <td>{{ $doctor->id }}</td>
                </tr> --}}

                {{-- NAME --}}
                <tr>
                    <th>Nome</th>
                    <td>{{ $user->name }}</td>
                </tr>
                {{-- /NAME --}}

                {{-- SURNAME --}}
                <tr>
                    <th>Cognome</th>
                    <td>{{ $user->surname }}</td>
                </tr>
                {{-- /SURNAME --}}


                {{-- PHONE NUMBER --}}
                <tr>
                    <th>Telefono</th>
                    <td>{{ $doctor->phone_number }}</td>
                </tr>
                {{-- /PHONE NUMBER --}}


                {{-- STUDIO ADDRESS --}}
                <tr>
                    <th>Indirizzo dello studio</th>
                    <td>{{ $doctor->studio_address }}</td>
                </tr>
                {{-- /STUDIO ADDRESS --}}


                {{-- PERFORMANCES --}}
                <tr>
                    <th>Prestazioni</th>
                    <td>
                        @forelse ($doctor->performances as $performance)
                            {{ $performance->title }}
                        @empty
                            nessuna specializzazione selezionata
                        @endforelse
                    </td>
                </tr>
                {{-- /PERFORMANCES --}}


                {{-- SPECIALIZATIONS --}}
                <tr>
                    <th>Specializzazioni</th>
                    <td>
                        @forelse ($doctor->specializations as $specialization)
                            {{ $specialization->title }}
                        @empty
                            nessuna specializzazione selezionata
                        @endforelse
                    </td>
                </tr>
                {{-- /SPECIALIZATIONS --}}


                {{-- CV --}}
                <tr>
                    <th>CV</th>
                    <td>
                        <embed class="doctor-cv" src=" {{ asset('storage/' . $doctor->CV) }}" alt="">
                    </td>
                </tr>
                {{-- /CV --}}


            </table>
            {{-- /TABLE --}}

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
