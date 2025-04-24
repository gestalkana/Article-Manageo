<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Article Manageo')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <style>
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #f8f9fa !important;
        }
        .footer {
            background-color: #212529;
            color: #f8f9fa;
        }
        .footer a {
            color: #f8f9fa;
        }
        .footer a:hover {
            color: #e9ecef;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Article Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link @yield('active_home')" href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('active_articles')" href="{{ route('articles.index') }}">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('active_authors')" href="{{ route('authors.index') }}">Auteurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('active_about')" href="#">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @yield('active_contact')" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4 flex-grow-1">
        @yield('content')
    </div>

    <footer class="footer pt-4 pb-2 mt-auto">
        <div class="container">
            <div class="row">
                <!-- Informations de contact -->
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt"></i> Adresse: 123 Rue Exemple, Ville, Pays</li>
                        <li><i class="fas fa-phone"></i> Téléphone: +123 456 789</li>
                        <li><i class="fas fa-envelope"></i> Email: Informatiako@gmail.com</li>
                    </ul>
                </div>
                <!-- Liens rapides -->
                <div class="col-md-4">
                    <h5>Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}">Accueil</a></li>
                        <li><a href="#">À propos</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="{{ route('authors.index') }}">Auteurs</a></li>
                    </ul>
                </div>
                <!-- Réseaux sociaux -->
                <div class="col-md-4">
                    <h5>Suivez-nous</h5>
                    <ul class="list-unstyled d-flex">
                        <li class="mr-3"><a href="#" class="text-white"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                        <li class="mr-3"><a href="#" class="text-white"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <li class="mr-3"><a href="#" class="text-white"><i class="fab fa-instagram"></i> Instagram</a></li>
                        <li><a href="#" class="text-white"><i class="fab fa-linkedin-in"></i> LinkedIn</a></li>
                    </ul>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="text-center">
                <p>&copy; 2024 Taleva Informatiako Company. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

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
                    <form id="editAuthorForm" method="POST" action="">
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
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, jQuery, and FontAwesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')
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
    </script>
</body>
</html>
