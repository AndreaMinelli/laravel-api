@if (session('msg'))
    <div class="alert alert-{{ session('type') }} mt-5" role="alert">
        {{ session('msg') }}
    </div>
@endif
