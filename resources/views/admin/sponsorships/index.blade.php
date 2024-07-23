@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="container mt-5">

        @if (session('message'))
        <div class="alert alert-success mt-5">
            {{ session('message') }}
        </div>
        @endif
        <h1 class="mb-4 text-light text-center">Lista delle Sponsorizzazioni</h1>

        <div class="row">
            @foreach ($sponsorships as $sponsorship)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-center border-bottom pb-2">{{ $sponsorship->name }}</h5>
                        <p class="card-text text-center mt-3"><strong>Prezzo:</strong> {{ number_format($sponsorship->price, 2) }} €</p>
                        <p class="card-text text-center"><strong>Durata:</strong> {{ $sponsorship->duration }} ore</p>
                    </div>
                    <form action="{{ route('admin.sponsorships.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sponsorship_id" value="{{ $sponsorship->id }}">
                        <button type="submit" class="btn btn-primary">Attiva Sponsorizzazione</button>
                    </form>

                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection