@extends('layouts.app')

@section('title', 'Manas Receptes')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Manas Receptes</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('recipes.create') }}" class="btn btn-primary mb-3">Pievienot Recepti</a>

            @if ($recipes->isEmpty())
                <p>Nav pievienotu recepšu.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nosaukums</th>
                                <th>Kategorija</th>
                                <th>Darbības</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recipes as $recipe)
                                <tr>
                                    <td><a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a></td>
                                    <td>{{ $recipe->category->name }}</td>
                                    <td>
                                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-sm btn-warning">Rediģēt</a>
                                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Vai tiešām vēlies dzēst šo recepti?')">Dzēst</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $recipes->links() }}
            @endif
        </div>
    </div>
@endsection