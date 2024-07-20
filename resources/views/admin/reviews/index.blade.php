@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Lista delle recensioni</h1>
    <table class="table mt-5">
        <thead>

            <tr>
                
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <!-- <th scope="col">Messaggio</th> -->
                <th scope="col">Data</th>
                <!-- <th scope="col">Stato</th> -->
                 <th scope="col">Azioni</th> 
            </tr>

        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
               
                <td scope="col">{{$review->guest_name}}</td>
                <td>{{$review->guest_mail}}</td>
                <!-- <td>{{$review->review}}</td> -->
                <td>{{ $review->created_at->format('d-m-Y H:i') }}</td>
                <td class="d-flex gap-2">

                    <a href="{{route('admin.reviews.show', ['review' => $review->id]) }}" class="btn btn-outline-info" title="Dettagli">
                        <i class="fa-solid fa-circle-info"></i>
                    </a>

                </td>
               
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection