@extends('layouts.app')

@section('title', 'Modifier un auteur')

@section('content')
<div class="container">
    <h1>Modifier un auteur</h1>
    <form action="{{ route('authors.update', $author->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $author->name) }}" required>
        </div>
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" id="bio" class="form-control">{{ old('bio', $author->bio) }}</textarea>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $author->age) }}">
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">
            @if ($author->photo)
                <img src="{{ asset('storage/' . $author->photo) }}" alt="Photo de {{ $author->name }}" width="100">
            @endif
        </div>

        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $author->phone) }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $author->email) }}" required>
        </div>
        <p>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>

         
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Annuler</a>
        </p>
    </form>
</div>
@endsection
