@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        @if ($messages)
            <div class="row">
                <table class="table table-borderless bg-transparent">
                    <thead>
                        <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Messaggio</th>
                            <th scope="col">Azioni</th>
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
                                <td><a href="{{ route('admin.messages.show', ['message' => $message->id]) }}" class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
