@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-light">Dettaglio della recensione</h1>

    <div class="card card-review mt-3 shadow-sm" style="width: 100%;">
        <div class="card-body">
        <h5 class=" text-capitalize fw-bold mt-3">{{ ucfirst(strtolower($review->guest_name)) }}</h5>
        <p class="text-muted">Indirizzo mail: <strong>{{ $review->guest_mail }}</strong></p>
            <h5 class="card-title">Recensione</h5>
            <p class="card-text">{{$review->review}}</p>
            <hr>
            <p class="text-muted">Il <strong>{{ $review->created_at->format('d-m-Y H:i') }}</strong></p>
            
        </div>
    </div>
</div>
@endsection
