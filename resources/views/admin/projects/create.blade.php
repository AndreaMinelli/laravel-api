@extends('layouts.app')

@section('title', 'New project')

@section('content')
    <h1 class="text-center my-4">Crea nuovo progetto</h1>
    @include('includes.projects.form')
@endsection
