@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-light">Dettaglio della Messaggio</h1>
    <div class="card mt-3 shadow-sm" style="width: 100%;">
        <div class="card-body">
            <h5 class=" text-capitalize fw-bold mt-3">{{ $message->guest_name }}</h5>
            <p class="text-muted">Indirizzo mail: <strong>{{ $message->guest_mail }}</strong></p>
            <hr>
            <h5 class="card-title">Messaggio:</h5>
            <p class="card-text">{{$message->message}}</p>
            <hr>
            <p class="text-muted">Il <strong>{{ $message->created_at->format('d-m-Y H:i') }}</strong></p>
        </div>
    </div>
</div>
@endsection
