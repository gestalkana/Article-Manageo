@extends('layouts.app')

@section('title', 'Liste des Articles')

@section('content')
<div class="container">
    <h1>Liste des articles</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">
        Créer un nouvel article
    </a>
    <table class="table mt-4 table-sm">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Auteur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Initialise le compteur pour gérer l'affichage des ID
                $counter = ($articles->currentPage() - 1) * $articles->perPage() + 1; 

                // $articles->currentPage() : retourne la page actuelle dans la pagination
                //$articles->perPage() : retourne le nombre d'éléments par page. Par exemple, si vous avez défini 10 articles par page, cela renverra 10
            @endphp
            @foreach($articles as $article)
                <tr class="text-center">
                    <td>{{ $counter++ }}</td> <!-- <td>{{ $article->id }}</td> -->
                    <td>{{ \Illuminate\Support\Str::limit($article->titre, 20, '...') }}</td>
                    <td class="text-truncate" style="max-width: 150px;">{{ \Illuminate\Support\Str::limit($article->contenu, 50, '...') }}</td>
                    <!-- Gestion du cas où author est null -->
                    <td>{{ $article->author ? $article->author->name : 'Auteur inconnu' }}</td>
                    <td>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info btn-sm mb-1">Voir</a>
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm mb-1">Modifier</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Ajouter des liens de pagination -->
    <div class="d-flex justify-content-center">
       {{ $articles->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection


@section('styles')
<style>
.table td {
    font-size: 0.875rem; /* Réduire la taille de la police */
}

.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 200px; /* Ajustez cette valeur selon vos besoins */
}
</style>
@endsection

