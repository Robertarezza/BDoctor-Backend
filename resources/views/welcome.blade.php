@extends('layouts.app')
@section('content')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<div class="jumbotron p-5 mb-4 bg-light rounded-3">
    <div class="container py-5">
        <div class="d-flex justify-content-center gap-3">
            <div class="logo_laravel">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Personalizzato" style="width: 62px;">
                <span style="font-size: smaller; font-weight: 900;">D-Doctor</span>
            </div>
            <h1 class="display-5 fw-bold">
                Benvenuto nella Dashbord di D-Doctor
            </h1>
        </div>
        <p class=" text-center" style="font-size: 45px; font-weight: 900;">Scegli una delle opzioni</p>
        <div class="d-flex justify-content-center gap-5">
        <div class="card" style="width: 18rem;">
            <div class="card-body text-center">
                <h5 class="card-title">Login</h5>
                <p class="card-text">Effettua il Login alla Dshboard per gestire al meglio il tuo profilo e visualizza messaggi e recensioni</p>
                <a  href="{{ route('login') }}" class="btn btn-primary">{{ __('Login') }}</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body text-center">
                <h5 class="card-title">Registrati</h5>
                <p class="card-text">Registrati gratuitamente alla Dshboard per gestire al meglio il tuo profilo e visualizza messaggi e recensioni</p>
                <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Register') }}</a>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis accusamus dolores!</p>
    </div>
</div>
@endsection