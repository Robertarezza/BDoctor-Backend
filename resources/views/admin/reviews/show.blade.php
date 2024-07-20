@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-light">Dettaglio della recensione</h1>
    <h5 class="text-light mt-3">{{ ucfirst(strtolower($review->guest_name)) }} scrive :</h5>
       <div class="card" style="width: 18rem;">
        <div class="card-body">
            <p class="card-text">{{$review->review}}</p>
            <p>Il {{$review->created_at}}</p>
            <p>Indirizzo mail {{$review->guest_mail}}</p>
            
        </div>
    </div>
</div>
@endsection