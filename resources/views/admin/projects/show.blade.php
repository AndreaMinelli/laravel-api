@extends('layouts.app')

@section('title', $project->name)

@section('content')

    <h1 class="text-center my-4 text-capitalize">{{ $project->name }}</h1>
    <p>{{ $project->description }}</p>
    <div class="d-flex justify-content-between">
        <p><strong>Repository: <a href="{{ $project->project_link }}">{{ $project->getProjectLink() }}</a></strong></p>
        <p><strong>Pubblicato:</strong> {{ $project->published ? 'Si' : 'No' }}</p>
        <p><strong>Tipo progetto:</strong> {{ $project->type ? $project->type->name : 'N.D.' }}</p>
        <p><strong>Tecnologie:</strong>
            @forelse ($project->technologies as $technology)
                {{ $technology->name }} @if (!$loop->last)
                    ,
                @endif
            @empty
                N.D.
            @endforelse
        </p>
        <p><strong>Ultimo Agg.:</strong> {{ $project->updated_at }}</p>
    </div>
    <div class="d-flex justify-content-center">
        @if ($project->project_img)
            <img src="{{ asset('storage/' . $project->project_img) }}" alt="{{ $project->name }}">
        @endif
    </div>
    <div class="d-flex justify-content-end my-4">
        <a class="btn btn-warning btn-sm text-white" href="{{ route('admin.projects.edit', $project->id) }}">Modifica</a>
        <a class="btn btn-secondary btn-sm mx-2" href="{{ route('admin.projects.index') }}">Torna indietro</a>
        <form action="{{ route('admin.projects.destroy', $project->id) }}" class="delete-form" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger btn-sm">Elimina</button>
        </form>
    </div>

@endsection
