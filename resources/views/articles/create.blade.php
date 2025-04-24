@extends('layouts.app')

@section('title', 'Créer un nouvel article')

@section('content')
    <div class="container">
        <h1>Créer un nouvel article</h1>

        {{-- Affichage des erreurs --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.store') }}" method="POST">
            @csrf

            {{-- Titre --}}
            <div class="form-group">
                <label for="titre">Titre <span class="text-danger">*</span></label>
                <input type="text" name="titre" id="titre" 
                    class="form-control @error('titre') is-invalid @enderror" 
                    value="{{ old('titre') }}">

                @error('titre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Contenu --}}
            <div class="form-group">
                <label for="contenu">Contenu (obligatoire)</label>
                <textarea name="contenu" id="contenu" rows="10" 
                    class="form-control @error('contenu') is-invalid @enderror">{{ old('contenu') }}</textarea>

                @error('contenu')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Auteur --}}
            <div class="form-group">
                <label for="inputState" class="form-label">Auteur <small class="text-muted">Ce champ est obligatoire.</small>
</label>
                <select id="inputState" name="author_id" class="form-select form-control @error('author_id') is-invalid @enderror">
                    <option value="" selected>Choisir...</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>

                @error('author_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Boutons --}}
            <p>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">Annuler</a>
            </p>
        </form>
    </div>
@endsection
