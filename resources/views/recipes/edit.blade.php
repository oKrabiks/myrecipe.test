<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediģēt Recepti</title>
    </head>
<body>
    <h1>Rediģēt Recepti</h1>

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Nosaukums:</label>
            <input type="text" id="title" name="title" value="{{ $recipe->title }}" required>
        </div>

        <div class="form-group">
            <label for="ingredients">Sastāvdaļas:</label>
            <textarea id="ingredients" name="ingredients" required>{{ $recipe->ingredients }}</textarea>
        </div>

        <div class="form-group">
            <label for="steps">Pagatavošanas Soļi:</label>
            <textarea id="steps" name="steps" required>{{ $recipe->steps }}</textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Kategorija:</label>
            <select id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $recipe->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="keyword_id">Atslēgvārds:</label>
            <select id="keyword_id" name="keyword_id">
                <option value="">Nav</option>
                @foreach ($keywords as $keyword)
                    <option value="{{ $keyword->id }}" {{ $recipe->keywords->contains($keyword->id) ? 'selected' : '' }}>{{ $keyword->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="photo">Attēls:</label>
            <input type="file" id="photo" name="photo" accept="image/*">
            @if ($recipe->photo)
                <img src="{{ asset('storage/recipes/' . $recipe->photo) }}" alt="{{ $recipe->title }}" width="200">
            @endif
        </div>

        <button type="submit">Atjaunot</button>
    </form>

    <a href="{{ route('recipes.index') }}">Atpakaļ uz receptēm</a>
    </body>
</html>