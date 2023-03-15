@extends('layouts.app')

@section('title', 'Projects')
@section('cdns')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css'
        integrity='sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=='
        crossorigin='anonymous' />
@endsection

@section('content')
    <h1 class="text-center my-4">I miei progetti</h1>
    <div class="d-flex justify-content-between align-items-center my-4">
        <a class="btn btn-success" href="{{ route('admin.projects.create') }}">Aggiungi progetto</a>
        <form action="{{ route('admin.projects.index') }}" method="get" class="input-group w-25">
            <select class="form-select" name="published">
                <option value=""selected>Tutti</option>
                <option value="published"@if (request('published') === 'published') selected @endif>Pubblicati</option>
                <option value="unpublished"@if (request('published') === 'unpublished') selected @endif>Non pubblicati</option>
            </select>
            <button class="btn btn-outline-secondary" type="submit">Filtra</button>
        </form>
    </div>
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Tipo</th>
                <th scope="col">Link Git Hub</th>
                <th scope="col">Ultimo Agg.</th>
                <th scope="col">Pub.</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->name }}</th>
                    <td>{{ $project->getDescription() }}</td>
                    <td>{{ $project->type ? $project->type->name : 'N.D.' }}</td>
                    <td><a href="{{ $project->project_link }}">{{ $project->getProjectLink() }}</a></td>
                    <td>{{ $project->updated_at }}</td>
                    <td>{{ $project->published ? 'Si' : 'No' }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.projects.show', $project->id) }}"><i
                                class="fa-solid fa-eye"></i></a>
                        <a class="btn btn-warning btn-sm text-white"
                            href="{{ route('admin.projects.edit', $project->id) }}"><i class="fa-solid fa-pencil"></i></a>
                        <form action="{{ route('admin.projects.destroy', $project->id) }}" class="delete-form d-inline"
                            method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" scope="row" class="text-center">
                        Non ci sono progetti da visualizzare
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class='d-flex justify-content-center my-5 '>
        {{ $projects->links() }}
    </div>
@endsection
