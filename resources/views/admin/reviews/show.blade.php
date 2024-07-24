@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-light">Dettaglio della recensione</h1>

    <div class="card card-review mt-3 shadow-sm" style="width: 100%;">
        <div class="card-body">
        <h5 class=" text-capitalize mt-3">Nome: <span class="fw-bold">{{ ucfirst(strtolower($review->guest_name)) }}</span></h5>
        <hr>
        <h5>Indirizzo mail: <strong>{{ $review->guest_mail }}</strong></h5>
        <hr>
        <h5 class="card-title">Recensione: <strong>{{$review->review}}</strong></h5>
        <p class="card-text"></p>
        <hr>
        <h5>Recensione ricevuta il <strong>{{ $review->created_at->format('d-m-Y H:i') }}</strong></h5>
            
        </div>
    </div>
</div>
@endsection
