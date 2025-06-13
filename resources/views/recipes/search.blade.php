@extends('layouts.app')

@section('title', 'Meklēšanas rezultāti')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4 text-center">Meklēšanas rezultāti: "{{ $query ?? '' }}"</h1>

                <form action="{{ route('search') }}" method="GET" class="mb-5 p-4 bg-light rounded shadow-sm d-flex flex-column flex-md-row align-items-center justify-content-center gap-3">
                    <input type="hidden" name="query" value="{{ $query ?? '' }}">

                    <div class="form-group w-100 w-md-33">
                        <label for="category" class="form-label fw-bold">Kategorija:</label>
                        <select
                            id="category"
                            name="category_id"
                            class="form-select" 
                        >
                            <option value="0" {{ (isset($selectedCategory) && $selectedCategory == 0) ? 'selected' : '' }}>Visas kategorijas</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ (isset($selectedCategory) && $selectedCategory == $cat->id) ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group w-100 w-md-33">
                        <label for="selected_keyword_id" class="form-label fw-bold">Atslēgvārds (etiķete):</label>
                        <select
                            id="selected_keyword_id"
                            name="selected_keyword_id"
                            class="form-select"
                        >
                            <option value="0" {{ (isset($selectedKeywordId) && $selectedKeywordId == 0) ? 'selected' : '' }}>Visi atslēgvārdi</option>
                            @foreach ($keywords as $kw)
                                <option value="{{ $kw->id }}" {{ (isset($selectedKeywordId) && $selectedKeywordId == $kw->id) ? 'selected' : '' }}>
                                    {{ $kw->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-100 w-md-auto mt-4 mt-md-0">
                        <button
                            type="submit"
                            class="btn btn-primary w-100" 
                        >
                            Filtrēt
                        </button>
                    </div>
                </form>

                
                @if ($recipes->isEmpty())
                    <p class="lead text-center mt-4">Nav atrasta neviena recepte, kas atbilst jūsu kritērijiem.</p>
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
                                                @foreach($recipe->keywords as $keyword)
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
                        {{ $recipes->appends(request()->input())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush
