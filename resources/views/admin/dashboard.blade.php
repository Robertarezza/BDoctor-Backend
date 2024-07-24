@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 mt-4">
            <div class="card bg-light shadow-sm">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h1 class="text-capitalize text-center">Benvenuto! Dr. {{ $user->name }} {{ $user->surname }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <!-- Messaggi -->
        <div class="col-12 col-md-6 mb-4">
            @if ($messages)
            <h2 class="text-center mb-4 text-light">L'ultimo messaggio ricevuto</h2>
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">{{ $messages->guest_name }} {{ $messages->guest_surname }}</h3>
                    <p class="card-text">Email: {{ $messages->guest_mail }}</p>
                    <hr>
                    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($messages->created_at)->format('d-m-Y H:i') }}</p>
                    <p><strong>Messaggio:</strong> {{ $messages->message }}</p>
                </div>
            </div>
            @else
            <h2 class="text-center mb-4 text-light">Nessun messaggio ricevuto</h2>
            @endif
        </div>

        <!-- Recensioni -->
        <div class="col-12 col-md-6 mb-4">
            @if ($reviews)
            <h2 class="text-center mb-4 text-light">La tua ultima recensione</h2>
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">{{ ucfirst(strtolower($reviews->guest_name)) }}</h3>
                    <p class="card-text">Email: {{ $reviews->guest_mail }}</p>
                    <hr>
                    <p><strong>Data:</strong> {{ $reviews->created_at->format('d-m-Y H:i') }}</p>
                    <p><strong>Recensione:</strong> {{ $reviews->review }}</p>
                </div>
                @else
                <h2 class="text-center mb-4 text-light">Nessuna recensione presente</h2>
                @endif
            </div>
        </div>
        {{-- Visualizza le sponsorizzazioni attive --}}
        <h2>Sponsorizzazioni Attive</h2>
        @if ($activeSponsorships->isEmpty())
        <p>Non hai sponsorizzazioni attive.</p>
        @else
        <ul>
            @foreach ($activeSponsorships as $sponsorship)
            <li>
                Sponsorizzazione ID: {{ $sponsorship->id }} <br>
                Inizio: {{ $sponsorship->pivot->start_date }} <br>
                Fine: {{ $sponsorship->pivot->end_date }}
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</div>
@endsection