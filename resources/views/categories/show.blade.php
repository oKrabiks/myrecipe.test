@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $category->name }}</h1>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row">
                    @foreach ($recipes as $recipe)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                @if ($recipe->photo)
                                    <img src="{{ asset('storage/recipes/' . $recipe->photo) }}" class="card-img-top" alt="{{ $recipe->title }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a></h5>
                                    <p class="card-text">{{ Str::limit($recipe->ingredients, 100) }}</p>
                                    <p class="card-text">
                                        <small class="text-muted">Autors: {{ $recipe->user->name }}</small><br>
                                        <small class="text-muted">Pievienots: {{ $recipe->created_at->diffForHumans() }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $recipes->links() }}
            </div>
        </div>
    </div>
@endsection