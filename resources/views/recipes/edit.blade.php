@extends('layouts.app')

@section('title', 'Rediģēt Recepti')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Rediģēt Recepti</h1>

            <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3"> 
                    <label for="title" class="form-label">Nosaukums:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $recipe->title) }}" required>
                    @error('title')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Apraksts</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $recipe->description) }}</textarea>
                    @error('description')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3"> 
                    <label for="ingredients" class="form-label">Sastāvdaļas:</label>
                    <textarea class="form-control" id="ingredients" name="ingredients" rows="3" required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
                    @error('ingredients')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="steps" class="form-label">Pagatavošanas Soļi:</label>
                    <textarea class="form-control" id="steps" name="steps" rows="5" required>{{ old('steps', $recipe->steps) }}</textarea>
                    @error('steps')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3"> 
                    <label for="category_id" class="form-label">Kategorija:</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="">Izvēlies Kategoriju</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $recipe->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keyword_id">Atslēgas vārds:</label>
                    <select id="keyword_id" name="keyword_id">
                        <option value="">Nav</option>
                        @foreach ($keywords as $keyword)
                            <option value="{{ $keyword->id }}" {{ $recipe->keywords->contains($keyword->id) ? 'selected' : '' }}>{{ $keyword->name }}</option>
                        @endforeach
                </select>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Attēls:</label>
                    <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*">
                    @if ($recipe->photo)
                        <div class="mt-2">
                            <p>Pašreizējais attēls:</p>
                            <img src="{{ asset('storage/recipes/' . $recipe->photo) }}" alt="{{ $recipe->title }}" width="200" class="img-thumbnail">
                        </div>
                    @endif
                    @error('photo')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Atjaunot</button>
                <a href="{{ route('recipes.index') }}" class="btn btn-secondary mt-3">Atpakaļ uz receptēm</a>
            </form>
        </div>
    </div>
@endsection
