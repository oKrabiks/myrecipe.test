@extends('layouts.app')

@section('title', 'Lietotāju Pārvaldība')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">Lietotāju Pārvaldība</h1>

                @if ($users->isEmpty())
                    <p class="lead">Nav atrasts neviens lietotājs.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vārds</th>
                                    <th>E-pasts</th>
                                    <th>Statuss</th>
                                    <th>Darbības</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td> 
                                        <td>
                                            @if ($user->blocked)
                                                <span class="badge bg-danger">Bloķēts</span>
                                            @else
                                                <span class="badge bg-success">Aktīvs</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.users.toggleBlock', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-{{ $user->blocked ? 'success' : 'warning' }} btn-sm">
                                                    {{ $user->blocked ? 'Atbloķēt' : 'Bloķēt' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection