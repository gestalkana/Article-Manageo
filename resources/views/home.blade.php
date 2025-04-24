@extends('layouts.app')

@section('title', 'Accueil')

@section('active_home', 'active')

@section('content')
    <div class="container">

        <h1>Articles</h1>
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->titre }}</h5>
                            <p class="card-text">
                                {{ Str::limit($article->contenu, 100) }}
                            </p>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Lire la suite</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
       
        <div class="row">
           <h2>Nombre d'articles des meilleurs auteurs</h2>
            <div class="d-flex flex-wrap justify-content-around align-items-center">
                <!-- Diagramme en cercle -->
                <div style="width: 300px; height: 300px;">
                    <canvas id="topAuthorsChart"></canvas>
                </div>

                <!-- Diagramme en barres -->
                <div style="width: 400px; height: 300px;">
                    <canvas id="topAuthorsBarChart"></canvas>
                </div>
            </div>


            <h2>Top 3 Auteurs</h2>
            @foreach($topAuthors as $author)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="profile-image text-center">
                            @if ($author->photo && Storage::disk('public')->exists($author->photo))
                                <img src="{{ asset('storage/' . $author->photo) }}" alt="Photo de {{ $author->name }}" class="rounded-circle" width="200" height="200">
                            @else
                                <img src="{{ asset('images/avatar/default-profile.PNG') }}" alt="Avatar de {{ $author->name }}" class="rounded-circle" width="200" height="200">
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $author->name }}</h5>
                            <p class="card-text">Âge: {{ $author->age }}</p>
                            <p class="card-text">Articles: {{ $author->articles_count }}</p>
                            <p>
                                <a href="{{ route('authors.show', $author->id) }}" class="btn btn-info">
                                    Voir le profil détaillé
                                </a>
                            </p>
                            <p>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editAuthorModal" 
                                        data-id="{{ $author->id }}" data-name="{{ $author->name }}" data-age="{{ $author->age }}">
                                    Mettre à jour le profil
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editAuthorModal" tabindex="-1" role="dialog" aria-labelledby="editAuthorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAuthorModalLabel">Modifier l'auteur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editAuthorForm" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="authorName">Nom</label>
                            <input type="text" class="form-control" id="authorName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="authorAge">Âge</label>
                            <input type="number" class="form-control" id="authorAge" name="age" required>
                        </div>
                        <div class="form-group">
                            <label for="authorPhoto">Photo</label>
                            <input type="file" name="photo" id="authorPhoto" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#editAuthorModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var authorId = button.data('id');
            var authorName = button.data('name');
            var authorAge = button.data('age');

            var modal = $(this);
            modal.find('.modal-title').text('Modifier ' + authorName);
            modal.find('#authorName').val(authorName);
            modal.find('#authorAge').val(authorAge);
            modal.find('#editAuthorForm').attr('action', '/authors/' + authorId);
        });
    });
    //Doiagramme en cercle Chart js
   
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("topAuthorsChart").getContext("2d");

        var chart = new Chart(ctx, {
            type: "pie", // diagramme en cercle
            data: {
                labels: @json($topAuthors->pluck('name')), // Noms des auteurs
                datasets: [{
                    label: "Nombre d'articles",
                    data: @json($topAuthors->pluck('articles_count')), // Nombre d'articles
                    backgroundColor: ["#007bff", "#28a745", "#ffc107"], // Couleurs
                    borderColor: "#fff",
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: "right" // Légende en bas
                    }
                }
            }
        });
    });
    //diagramme en bar
    document.addEventListener("DOMContentLoaded", function () {
    var ctxBar = document.getElementById("topAuthorsBarChart").getContext("2d");

    var barChart = new Chart(ctxBar, {
        type: "bar", // Diagramme en barres
        data: {
            labels: @json($topAuthors->pluck('name')), // Noms des auteurs
            datasets: [{
                label: "Nombre d'articles",
                data: @json($topAuthors->pluck('articles_count')), // Nombre d'articles
                backgroundColor: ["#007bff", "#28a745", "#ffc107"], // Couleurs
                borderColor: "#fff",
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "top"
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

</script>

@endsection
