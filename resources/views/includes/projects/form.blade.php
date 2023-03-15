@if ($project->exists)
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" class="row g-3"
        enctype="multipart/form-data" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.projects.store') }}" method="POST" class="row g-3" enctype="multipart/form-data"
            novalidate>
@endif

@csrf
<div class="col-6">
    <label for="name" class="form-label">Nome Progetto:</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        placeholder="Inserisci nome progetto" value="{{ old('name', $project->name) }}" required>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-6">
    <label for="project_link" class="form-label">Git Hub Link:</label>
    <input type="url" class="form-control @error('project_link') is-invalid @enderror" id="project_link"
        name="project_link" value="{{ old('project_link', $project->project_link) }}"
        placeholder="Inserisci url del link" required>
    @error('project_link')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-4">
    <label for="type_id" class="form-label">Tipologia progetto:</label>
    <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
        <option value="" selected>N.D.</option>
        @foreach ($types as $type)
            <option @if (old('type_id', $project->type_id) == $type->id) selected @endif value="{{ $type->id }}">{{ $type->name }}
            </option>
        @endforeach
    </select>
    @error('type_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-7" id="upload-image">
    <label for="project_img" class="form-label">Immagine:</label>
    <div class="input-group mb-3">
        <button type="button" class="btn btn-primary rounded-end" id="show-image-input"
            style='display:{{ $project->exists ? 'block' : 'none' }}'>Cambia immagine</button>
        <input type="file" class="form-control rounded-start @error('project_img') is-invalid @enderror"
            id="project_img" name="project_img" style='display:{{ $project->exists ? 'none' : 'block' }}'
            onchange="preview(event)">
        @error('project_img')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
<div class="col-1 d-flex align-items-center">
    <img src="{{ $project->project_img ? asset('storage/' . $project->project_img) : 'https://www.innerintegratori.it/wp-content/uploads/2021/06/placeholder-image-300x225.png' }}"
        alt="image-preview" id="image-preview" class="img-fluid">
</div>


<div class="col-10">
    <label for="description" class="form-label">Descrizione:</label>
    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description', $project->description) }}</textarea>
    @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-2 d-flex align-items-end justify-content-end">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="published" name="published"
            @if (old('published', $project->published)) checked @endif>
        <label class="form-check-label" for="published">Pubblica</label>
    </div>
</div>

<div class="col-12 mt-4">
    <p class="mb-2">Tecnologie utilizzate:</p>
    @forelse ($technologies as $technology)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="tech-{{ $technology->id }}"
                value="{{ $technology->id }}" name="technologies[]"
                @if (count(old()) && !old('technologies')) @elseif(in_array($technology->id, old('technologies', $project_technologies ?? []))) checked @endif>
            <label class="form-check-label" for="tech-{{ $technology->id }}">{{ $technology->name }}</label>
        </div>
    @empty
        -
    @endforelse
    @error('technologies')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="text-end mt-5">
    <a class="btn btn-secondary"
        href="@if ($project->exists) {{ route('admin.projects.show', $project->id) }}
    @else
    {{ route('admin.projects.index') }} @endif">Annulla</a>
    <button class="btn btn-success">Salva</button>
</div>
</form>

@section('scripts')
    <script>
        const showImageInput = document.getElementById("show-image-input");
        const uploadImage = document.getElementById("project_img");
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
