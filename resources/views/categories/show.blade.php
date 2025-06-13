@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">{{ $category->name }}</h1>

                @if ($recipes->isEmpty())
                    <p class="lead text-center mt-4">Šajā kategorijā nav pieejamu recepšu.</p>
                @else
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach ($recipes as $recipe)
                            <div class="col">
                                <div class="card h-100 shadow-sm">
                                    @if ($recipe->photo)
                                        <img src="{{ asset('storage/recipes/' . $recipe->photo) }}" alt="{{ $recipe->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <i class="fas fa-utensils fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('recipes.show', $recipe->id) }}" class="text-decoration-none text-dark">{{ $recipe->title }}</a>
                                        </h5>
                                        <p class="card-text small text-muted">
                                            Kategorija: <a href="{{ route('categories.show', $recipe->category->id) }}" class="text-decoration-none">{{ $recipe->category->name }}</a>
                                            <br>
                                            Autors: {{ $recipe->user->name }}
                                        </p>
                                        @if ($recipe->keywords->isNotEmpty())
                                            <p class="card-text small">
                                                @foreach ($recipe->keywords as $keyword)
                                                    <a href="{{ route('keywords.show', $keyword->id) }}" class="badge bg-secondary text-decoration-none">{{ $keyword->name }}</a>@if(!$loop->last), @endif
                                                @endforeach
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $recipes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection