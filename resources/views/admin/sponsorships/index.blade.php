@extends('layouts.admin')

@section('content')

<div class="container">
<div class="container mt-5">
        <h1 class="mb-4 text-light text-center">Lista delle Sponsorizzazioni</h1>

        <div class="row">
            @foreach ($sponsorships as $sponsorship)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-center border-bottom pb-2">{{ $sponsorship->name }}</h5>
                            <p class="card-text text-center mt-3"><strong>Prezzo:</strong> €{{ number_format($sponsorship->price, 2) }}</p>
                            <p class="card-text text-center"><strong>Durata:</strong> {{ $sponsorship->duration }} ore</p>
                        </div>
                        <a href="" class="btn btn-primary mb-3 mt-5" style="width: 20%; margin: 0 auto;"> Scegli</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection