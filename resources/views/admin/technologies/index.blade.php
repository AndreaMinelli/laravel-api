@extends('layouts.app')

@section('title', 'Technolgies')
@section('cdns')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css'
        integrity='sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=='
        crossorigin='anonymous' />
@endsection

@section('content')
    <h1 class="text-center my-4">Tecnlogie utilizzate</h1>
    <div class="d-flex justify-content-end align-items-center my-3">
        <a class="btn btn-success" href="{{ route('admin.technologies.create') }}">Aggiungi tecnologia</a>
    </div>
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Ultimo Agg.</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($technologies as $technology)
                <tr>
                    <th scope="row">{{ $technology->id }}</th>
                    <td>{{ $technology->name }}</td>
                    <td>{{ $technology->updated_at }}</td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-warning btn-sm text-white mx-3"
                                href="{{ route('admin.technologies.edit', $technology->id) }}"><i
                                    class="fa-solid fa-pencil"></i></a>
                            <form action="{{ route('admin.technologies.destroy', $technology->id) }}"
                                class="delete-form d-inline" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" scope="row" class="text-center">
                        Non sono state ancora inserite le tecnologie utilizzate
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class='d-flex justify-content-center my-5 '>
        {{ $technologies->links() }}
    </div>
@endsection
