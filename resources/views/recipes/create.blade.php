@extends('layouts.app')

@section('title', 'Izveidot Recepti')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Izveidot Recepti</h1>

            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Nosaukums:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Apraksts</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="ingredients">Sastāvdaļas:</label>
                    <textarea class="form-control" id="ingredients" name="ingredients" rows="3" required>{{ old('ingredients') }}</textarea>
                    @error('ingredients')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="steps">Pagatavošanas Soļi:</label>
                    <textarea class="form-control" id="steps" name="steps" rows="5" required>{{ old('steps') }}</textarea>
                    @error('steps')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Kategorija:</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="">Izvēlies Kategoriju</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keywords">Atslēgvārdi:</label>
                    <select class="form-control" id="keywords" name="keywords[]" multiple>
                        @foreach($keywords as $keyword)
                            <option value="{{ $keyword->id }}">{{ $keyword->name }}</option>
                        @endforeach
                    </select>
                    @error('keywords')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="photo">Attēls:</label>
                    <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*">
                    @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Izveidot</button>
            </form>

            <a href="{{ route('recipes.index') }}" class="btn btn-secondary mt-3">Atpakaļ uz receptēm</a>
        </div>
    </div>
@endsection