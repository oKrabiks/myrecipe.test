@extends('layouts.app')

@section('title', 'Receptes')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">Receptes</h1>
                @if ($recipes->isEmpty())
                    <p class="lead">Nav pieejamu recepšu.</p>
                @else
                    <div class="row row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach ($recipes as $recipe)
                            <div class="col">
                                <div class="card h-100">
                                    @if ($recipe->photo)
                                        <img src="{{ asset('storage/recipes/' . $recipe->photo) }}" alt="{{ $recipe->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                        
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="{{ route('recipes.show', $recipe->id) }}" class="text-decoration-none text-dark">{{ $recipe->title }}</a></h5>
                                        <p class="card-text small text-muted">
                                            Kategorija: <a href="{{ route('categories.show', $recipe->category->id) }}" class="text-decoration-none">{{ $recipe->category->name }}</a>
                                            <br>
                                            Autors: {{ $recipe->user->name }}
                                        </p>
                                        <p class="card-text small">
                                            Atslēgas vārdi:
                                            @foreach ($recipe->keywords as $keyword)
                                                <a href="{{ route('keywords.show', $keyword->id) }}" class="badge bg-secondary text-decoration-none">{{ $keyword->name }}</a>@if(!$loop->last), @endif
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

