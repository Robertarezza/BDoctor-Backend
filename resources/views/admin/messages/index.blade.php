@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        @if ($messages)
            <div class="row">
                <table class="table mt-5 table-hover table-custom">
                    <thead>
                        <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Messaggio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)                            
                            <tr>
                                <th scope="row">{{ \Carbon\Carbon::parse($message->created_at)->format('d-m-Y H:i') }}</th>
                                <td>{{ $message->guest_name }}</td>
                                <td>{{ $message->guest_surname }}</td>
                                <td>{{ $message->guest_mail }}</td>
                                <td class="ms_text-overflow">{{ $message->message }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
