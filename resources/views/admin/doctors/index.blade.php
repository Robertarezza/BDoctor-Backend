@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Doctor Profile</h1>
        @if ($doctor)
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ $doctor->id }}</td>
                </tr>
                <tr>
                    <th>Nome</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Cognome</th>
                    <td>{{ $user->surname }}</td>
                </tr>

                <tr>
                    <th>Telefono</th>
                    <td>{{ $doctor->phone_number }}</td>
                </tr>
                <tr>
                    <th>Indirizzo dello studio</th>
                    <td>{{ $doctor->studio_address }}</td>
                </tr>
                <tr>
                    <th>Prestazioni</th>
                    <td>{{ $doctor->performance }}</td>
                </tr>
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
                <th>foto</th>
                <img src="{{ $doctor->photo }}" alt="foto">

            </table>
        @else
            <p>No doctor profile found for the logged in user.</p>
        @endif
    </div>
@endsection
