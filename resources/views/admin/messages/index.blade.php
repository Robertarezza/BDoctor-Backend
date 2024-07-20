@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        @if ($messages)
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">surname</th>
                            <th scope="col">e-mail</th>
                            <th scope="col">message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)                            
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $message->guest_name }}</td>
                                <td>{{ $message->guest_surname }}</td>
                                <td>{{ $message->guest_mail }}</td>
                                <td>{{ $message->message }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
