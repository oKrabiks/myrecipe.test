<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }}</title>
    </head>
<body>
    <h1>{{ $recipe->title }}</h1>

    <div class="recipe-details">
        <p>Kategorija: <a href="{{ route('categories.show', $recipe->category->id) }}">{{ $recipe->category->name }}</a></p>
        <p>Autors: {{ $recipe->user->name }}</p>
        @if ($recipe->photo)
            <img src="{{ asset('storage/recipes/' . $recipe->photo) }}" alt="{{ $recipe->title }}" width="400">
        @endif
        <p>Sastāvdaļas:</p>
        <pre>{{ $recipe->ingredients }}</pre>
        <p>Pagatavošanas Soļi:</p>
        <pre>{{ $recipe->steps }}</pre>

        <p>Atslēgvārdi:
            @foreach ($recipe->keywords as $keyword)
            <span class="badge bg-secondary">{{ $keyword->name }}</span>
            @endforeach
        </p>
    </div>

    <a href="{{ route('recipes.index') }}">Atpakaļ uz receptēm</a>
    </body>
</html>