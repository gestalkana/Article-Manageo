@extends('layouts.app')

@section('title', 'Liste des Auteurs')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Liste des Auteurs</h1>
    
    <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Ajouter un nouvel auteur</a><br>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Nom</th>
                <th>Bio</th>
                <th>Actions</th>
                <!-- Ajoutez d'autres colonnes si nécessaire -->
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $author->name }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($author->bio, 50, '...') }}</td>
                    <td>
                        <a href="{{ route('authors.show', $author->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning">    Modifier
                        </a>
                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                    <!-- Ajoutez d'autres informations si nécessaire -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
