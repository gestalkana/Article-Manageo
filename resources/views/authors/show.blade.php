@extends('layouts.app')

@section('title', 'Détails de l\'auteur')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <div class="profile-image" style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%; display: inline-block;">
            @if ($author->photo)
                <img src="{{ asset('storage/' . $author->photo) }}" alt="Photo de {{ $author->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <img src="{{ asset('images/avatar/default-profile.PNG') }}" alt="Photo de {{ $author->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            @endif
        </div>
        <h1 class="mt-3">{{ $author->name }}</h1>
    </div>
    <div class="profile-info">
        <p><strong>Email:</strong> {{ $author->email }}</p>
        <p><strong>Bio:</strong> {{ $author->bio }}</p>
        <p><strong>Age:</strong> {{ $author->age }}</p>
        <p><strong>Téléphone:</strong> {{ $author->phone }}</p>
    </div>
    <div class="author-articles mt-4">
        <h2>Articles de {{ $author->name }}</h2>
        @if($author->articles->isEmpty())
            <p>Aucun article trouvé.</p>
        @else
            <ul>
                @foreach($author->articles as $article)
                    <li><a href="{{ route('articles.show', $article->id) }}">{{ $article->titre }}</a></li>
                @endforeach
            </ul>
        @endif
        <p class="text-center mb-4"><a href="{{ route('authors.index') }}" class="btn btn-primary">Retour à la liste</a>
        </p>
    </div>
</div>
@endsection
