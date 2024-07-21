@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
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
@if ($messages)
<div class="container mt-4">
    <h2 class="text-center mb-4 text-light">l' ultimo messaggio ricevuto</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">{{ $messages->guest_name }} {{ $messages->guest_surname }}</h3>
                    <p class="card-text">{{ $messages->guest_mail }}</p>
                    <hr>
                    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($messages->created_at)->format('d-m-Y H:i') }}</p>
                    <p><strong>Email:</strong> {{ $messages->message }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container mt-4">
    <h2 class="text-center mb-4 text-light">Nessun messaggio ricevuto</h2>
</div>
@endif
@if ($reviews)
<div class="container mt-4">
    <h2 class="text-center mb-4 text-light">La tua ultima recensione</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">{{ ucfirst(strtolower($reviews->guest_name)) }}</h3>
                    <p class="card-text">{{ $reviews->review }}</p>
                    <hr>
                    <p><strong>Data:</strong> {{ $reviews->created_at->format('d-m-Y H:i') }}</p>
                    <p><strong>Email:</strong> {{ $reviews->guest_mail }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container mt-4">
    <h2 class="text-center mb-4 text-light">Nessuna recensione presente</h2>
</div>
@endif
@endsection
