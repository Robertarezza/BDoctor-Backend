@extends('layouts.admin')

@section('content')
    <h1 class="text-center m-5">Modifica il tuo profilo</h1>
    
    {{-- CONTAINER --}}
    <div class="container">
        {{-- FORM --}}
        @if(isset($doctor))
        <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- PHOTO --}}
            <div class="mb-3">
                <label for="photo" class="form-label">Inserisci una foto *</label>
                <input name="photo" type="file" id="photo" class="form-control @error('photo') is-invalid @enderror">
                @error('photo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- /PHOTO --}}

            {{-- PHOTO PREVIEW --}}
            <div class="mb-3">
                <img class="{{ $doctor->photo ? '' : 'd-none' }} doctor-photo" id="photo-preview" src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : '' }}" alt="Doctor Photo">
            </div>
            {{-- /PHOTO PREVIEW --}}

            {{-- SPECIALIZATIONS --}}
            <div class="mb-3">
                <label for="specialization" class="form-label">Specializzazioni *</label>
                <select name="specialization[]" id="specialization"
                    class="form-control @error('specialization') is-invalid @enderror d-none" multiple>
                    @foreach ($specializations as $specialization)
                        <option @selected(in_array($specialization->id, old('specialization', $doctor->specializations->pluck('id')->toArray())))  value="{{ $specialization->id }}">{{ $specialization->title }}</option>
                    @endforeach
                </select>
                @error('specialization')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- /SPECIALIZATIONS --}}

            {{-- PERFORMANCES --}}
            <div class="mb-3">
                <label for="performance" class="form-label">Prestazioni *</label>
                <select name="performance[]" id="performance"
                    class="form-control @error('performance') is-invalid @enderror d-none" multiple>
                    @foreach ($performances as $performance)
                        <option @selected(in_array($performance->id, old('performance', $doctor->performances->pluck('id')->toArray()))) value="{{ $performance->id }}">{{ $performance->title }}</option>
                    @endforeach
                </select>
                @error('performance')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- /PERFORMANCES --}}

            {{-- PHONE NUMBER --}}
            <div class="mb-3">
                <label for="phone_number" class="form-label">Numero di telefono *</label>
                <input type="tel" name="phone_number" id="phone_number"
                    class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $doctor->phone_number) }}">
                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- /PHONE NUMBER  --}}

            {{-- STUDIO ADDRESS --}}
            <div class="mb-3">
                <label for="studio_address" class="form-label">Indirizzo studio *</label>
                <input type="text" name="studio_address" id="studio_address"
                    class="form-control @error('studio_address') is-invalid @enderror" value="{{ old('studio_address', $doctor->studio_address) }}">
                @error('studio_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- /STUDIO ADDRESS --}}

            {{-- CV --}}
            <div class="mb-3">
                <label for="CV" class="form-label">Allega il tuo CV *</label>
                <input name="CV" type="file" id="CV" class="form-control @error('CV') is-invalid @enderror">
                @error('CV')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            {{-- /CV --}}

            {{-- CV PREVIEW --}}
            <div class="mb-3">
                <embed class="{{ $doctor->CV ? '' : 'd-none' }} doctor-cv" id="cv-preview" data="{{ $doctor->CV ? asset('storage/' . $doctor->CV) : '' }}" type="" >
                   
            </div>
            {{-- /CV PREVIEW --}}

            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
        @else
            <p>Il profilo del dottore non è stato trovato.</p>
        @endif
        {{-- FORM --}}
    </div>
    {{-- /CONTAINER --}}

    {{-- SCRIPT FOR MULTISELECT --}}
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
        });
    </script>
    {{-- /SCRIPT FOR MULTISELECT --}}

    {{-- SCRIPT FOR IMAGE PREVIEW --}}
    <script>
        document.getElementById('photo').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('photo-preview').classList.remove('d-none');
                document.getElementById('photo-preview').src = URL.createObjectURL(file);
            }
        });

        document.getElementById('CV').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('cv-preview').classList.remove('d-none');
                document.getElementById('cv-preview').data = URL.createObjectURL(file);
            }
        });
    </script>
    {{-- /SCRIPT FOR IMAGE PREVIEW --}}
@endsection
