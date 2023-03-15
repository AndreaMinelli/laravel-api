@if ($technology->exists)
    <form action="{{ route('admin.technologies.update', $technology->id) }}" method="POST" class="row g-3"
        enctype="multipart/form-data" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.technologies.store') }}" method="POST" class="row g-3" enctype="multipart/form-data"
            novalidate>
@endif

@csrf
<div class="col-6">
    <label for="name" class="form-label">Nome Progetto:</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        placeholder="Inserisci nome tecnologia" value="{{ old('name', $technology->name) }}" required>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


<div class="col-5" id="upload-image">
    <label for="logo" class="form-label">Logo:</label>
    <div class="input-group mb-3">
        <button type="button" class="btn btn-primary rounded-end" id="show-image-input"
            style='display:{{ $technology->exists ? 'block' : 'none' }}'>Cambia logo</button>
        <input type="file" class="form-control rounded-start @error('logo') is-invalid @enderror" id="logo"
            name="logo" style='display:{{ $technology->exists ? 'none' : 'block' }}' onchange="preview(event)">
        @error('logo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="col-1 d-flex align-items-center">
    <img src="{{ $technology->logo ? asset('storage/' . $technology->logo) : 'https://www.innerintegratori.it/wp-content/uploads/2021/06/placeholder-image-300x225.png' }}"
        alt="image-preview" id="image-preview" class="img-fluid">
</div>

<div class="text-end mt-5">
    <a class="btn btn-secondary" href="{{ route('admin.technologies.index') }}">Annulla</a>
    <button class="btn btn-success">Salva</button>
</div>
</form>

@section('scripts')
    <script>
        const showImageInput = document.getElementById("show-image-input");
        const uploadImage = document.getElementById("logo");
        showImageInput.addEventListener("click", () => {
            showImageInput.style.display = 'none';
            uploadImage.style.display = 'block';
        });
    </script>
    <script>
        const imagePreview = document.getElementById("image-preview");
        const preview = function(event) {
            if (event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function() {
                    imagePreview.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        };
    </script>
@endsection
