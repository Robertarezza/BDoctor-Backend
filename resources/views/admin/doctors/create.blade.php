@extends('layouts.admin')

@section('content')
    <h1 class="text-center m-5">Create your profile</h1>

    <form action="{{ route('admin.doctors.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="formFile" class="form-label">Inserisci una foto *</label>
            <input class="form-control" name="photo" type="file" id="formFile">
        </div>
        <div class="mb-3">
            <label for="number" class="form-label">Numero di telefono *</label>
            <input type="number" name="phone_number" class="form-control" id="number">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo studio *</label>
            <input type="text" name="studio_address" class="form-control" id="address">
        </div>
        <div class="mb-3">
            <label for="CV" class="form-label">Allega il tuo CV *</label>
            <input class="form-control" name="CV" type="file" id="CV">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo studio *</label>
            <input type="text" name="studio_address" class="form-control" id="address">
        </div>
        <div class="mb-3">
            <label for="specialization" class="form-label">Prestazioni *</label>
            <select name="specialization[]" id="specialization" class="form-control selectpicker" multiple="multiple">
                @foreach ($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
