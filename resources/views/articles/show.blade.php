@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $article->titre }}</h1>
        <p>{{ $article->contenu }}</p>
    
        <a href="{{ route('articles.index') }}" class="btn btn-primary">Retour à la liste</a>
        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">Modifier</a>
        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline-block; margin-bottom: 10px">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    
    </div>
@endsection
