@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 mt-4">
            <div class="card bg-light shadow-sm card-review">
                <div class="card-body text-center">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h1 class="text-capitalize">Benvenuto! Dr. {{ $user->name }} {{ $user->surname }}</h1>
                    <div class="mt-2 text-primary small">
                        {{-- Sponsorizzazione Attiva --}}
                        @if (!$activeSponsorship)
                        <p>Non hai sponsorizzazioni attive.</p>
                        @else
                        <p>Hai una sponsorizzazione attiva fino al:
                            <span class="font-weight-bold">{{ \Carbon\Carbon::parse($activeSponsorship->pivot->end_date)->format('d-m-Y') }}</span>
                        </p>
                        @endif
                    </div>

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
                    <h3 class="card-title">{{ ucwords(strtolower($messages->guest_name)) }} {{ ucwords(strtolower($messages->guest_surname)) }}</h3>
                    <p class="card-text">Email: {{ $messages->guest_mail }}</p>
                    <hr>
                    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($messages->created_at)->format('d-m-Y H:i') }}</p>
                    <p><strong>Messaggio:</strong> {{ ucfirst(strtolower($messages->message)) }}</p>
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
                    <h3 class="card-title">{{ ucwords(strtolower($reviews->guest_name)) }}</h3>
                    <p class="card-text">Email: {{ $reviews->guest_mail }}</p>
                    <hr>
                    <p><strong>Data:</strong> {{ $reviews->created_at->format('d-m-Y H:i') }}</p>
                    <p><strong>Recensione:</strong> {{ ucfirst(strtolower($reviews->review)) }}</p>
                </div>
            </div>
            @else
            <h2 class="text-center mb-4 text-light">Nessuna recensione presente</h2>
            @endif
        </div>
        <div class="bg-light">
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        // Dati per il grafico
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Recensioni', 'Messaggi', 'Valutazioni'],
                datasets: [{
                    label: 'Numero di',
                    data: [{{ $reviewsCount }}, {{ $messagesCount }}, {{ $ratingsCount }}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection
