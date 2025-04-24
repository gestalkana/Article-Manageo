@extends('layouts.app')

@section('title', 'Créer un nouvel auteur')

@section('content')
<div class="container">
    <h1>Créer un nouvel auteur</h1>
    <form action="{{ route('authors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" id="bio" class="form-control">{{ old('bio') }}</textarea>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="{{ old('age') }}">
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>

        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>

        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Annuler</a>
        
    </form>
</div>
@endsection
