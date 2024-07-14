@extends('layouts.admin')

@section('content')
    <h1 class="text-center m-5">Create your profile</h1>

    <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="photo" class="form-label">Inserisci una foto *</label>
            <input class="form-control" name="photo" type="file" id="photo">
        </div>
        <div class="mb-3">
            <img class="d-none" id="photo-preview" src="" alt="">
        </div>
        <div class="mb-3">
            <label for="specialization" class="form-label">Specializzazioni *</label>
            <select name="specialization[]" id="specialization" class="form-control d-none" multiple>
                @foreach ($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="performance" class="form-label">Prestazioni *</label>
            <select name="performance[]" id="performance" class="form-control d-none" multiple>
                @foreach ($performances as $performance)
                    <option value="{{ $performance->id }}">{{ $performance->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Numero di telefono *</label>
            <input type="number" name="phone_number" class="form-control" id="phone_number">
        </div>
        <div class="mb-3">
            <label for="studio_address" class="form-label">Indirizzo studio *</label>
            <input type="text" name="studio_address" class="form-control" id="studio_address">
        </div>
        <div class="mb-3">
            <label for="CV" class="form-label">Allega il tuo CV *</label>
            <input class="form-control" name="CV" type="file" id="CV">
        </div>
        <div class="mb-3">
            <img class="d-none" id="cv-preview" src="" alt="">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script>
        // https://github.com/habibmhamadi/multi-select-tag
        new MultiSelectTag('specialization', {
            rounded: true, // default true
            shadow: false, // default false
            placeholder: 'Search', // default Search...
            tagColor: {
                textColor: '#327b2c',
                borderColor: '#92e681',
                bgColor: '#eaffe6',
            },
            onChange: function(values) {
                console.log(values)
            }
        });
        new MultiSelectTag('performance', {
            rounded: true, // default true
            shadow: false, // default false
            placeholder: 'Search', // default Search...
            tagColor: {
                textColor: '#327b2c',
                borderColor: '#92e681',
                bgColor: '#eaffe6',
            },
            onChange: function(values) {
                console.log(values)
            }
        })

    </script>
@endsection
