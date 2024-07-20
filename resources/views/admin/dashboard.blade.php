@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center t">
        <div class="col-md-8 mt-4">
            <div class="card bg-none">
                {{-- <div class="card-header">Homepage</div> --}}

                <div class="card-body ">
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
@if ($reviews) {{-- Controlla se la variabile $reviews è settata --}}
<div class="container mt-4">
    <h2 class="text-center mb-4 border text-light">La tua ultima recensione</h2>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ ucfirst(strtolower($reviews->guest_name)) }}</h1>
                    <p class="card-text">{{ $reviews->review }}</p>
                    <p><strong>Data:</strong> {{ $reviews->created_at->format('d-m-Y H:i') }}</p>
                    <p><strong>Email:</strong> {{ $reviews->guest_mail }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container mt-4">
    <h2 class="text-center mb-4 border text-light">Nessuna recensione presente</h2>
</div>
@endif

@endsection