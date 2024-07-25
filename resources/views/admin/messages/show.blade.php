@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-light">Dettaglio della Messaggio</h1>
    <div class="card card-message mt-3 shadow-sm" style="width: 100%;">
        <div class="card-body">
            <h5 class=" text-capitalize mt-3">Nome: <span class="fw-bold">{{ $message->guest_name }}</span></h5>
            <hr>
            <h5>Indirizzo mail: <strong>{{ $message->guest_mail }}</strong></h5>
            <hr>
            <h5 class="card-title">Messaggio: <strong>{{ ucfirst(strtolower($message->message)) }}</strong></h5>
            <hr>
            <h5>Messaggio ricevuto il <strong>{{ ucfirst(strtolower($message->created_at->format('d-m-Y H:i'))) }}</strong></h5>
        </div>
    </div>
</div>
@endsection
