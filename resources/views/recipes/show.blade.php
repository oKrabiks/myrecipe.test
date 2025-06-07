
@extends('layouts.app')

@section('title', $recipe->title)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <h1 class="mb-2">{{ $recipe->title }}</h1>
                <p class="text-muted small mb-4">Autors: {{ $recipe->user->name }}</p>
                
                <img src="{{ asset('storage/recipes/' . $recipe->photo) }}" alt="{{ $recipe->title }}" class="img-fluid mb-4" style="max-width: 400px; height: auto;">
                
                @if ($recipe->description)
                    <div class="mb-4">
                        <p>{{ $recipe->description }}</p>
                    </div>
                @endif

                <h2 class="h5 mb-2">Sastāvdaļas:</h2>
                <p class="mb-4">{!! nl2br(e($recipe->ingredients)) !!}</p> 



                <h2 class="h5 mb-2">Pagatavošanas Soļi:</h2>
                <p class="mb-4">{!! nl2br(e($recipe->steps)) !!}</p>

                <p class="text-muted small mb-2">
                    Kategorija: <a href="{{ route('categories.show', $recipe->category->id) }}" class="text-decoration-none">{{ $recipe->category->name }}</a>
                </p>

                <p class="text-muted small">
                    Atslēgvārdi:
                    @foreach ($recipe->keywords as $keyword)
                        <span class="badge bg-secondary">{{ $keyword->name }}</span>@if(!$loop->last), @endif
                    @endforeach
                </p>

                <div class="mt-4">
                    <a href="{{ route('recipes.index') }}" class="btn btn-outline-primary btn-sm">Atpakaļ uz receptēm</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color:rgb(255, 255, 255);
        }

    </style>
@endpush

