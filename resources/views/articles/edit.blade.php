@extends('layouts.app')

@section('title', 'Modifier un article')

@section('content')
    <div class="container">
        <h1>Modifier l'article</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" class="form-control" id="titre" value="{{ old('titre', $article->titre) }}">
            </div>

            <div class="form-group">
                <label for="contenu">Contenu</label>
                <textarea name="contenu" class="form-control" id="contenu" rows="10" cols="50">{{ old('contenu', $article->contenu) }}</textarea>
            </div>

            

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            
            <!-- Bouton d'annulation -->
            <a href="{{ route('articles.index') }}" class="btn btn-secondary">Annuler</a>

        </form>
    </div>
@endsection
