<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RH Gestion | Accueil Professionnel</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Style personnalisé pour l'image d'arrière-plan */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?q=80&w=1974&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .card-feature {
            transition: transform 0.3s;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .card-feature:hover {
            transform: translateY(-10px);
        }

        .icon-box {
            font-size: 2.5rem;
            color: #0d6efd;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="fas fa-briefcase me-2"></i>RH-MANAGER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Employés</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Départements</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-lg-3" href="{{ route('login') }}">Connexion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3">Gestion des employees</h1>
            <p class="lead mb-5">Optimisez le suivi de vos employés et la structure de votre entreprise en toute simplicité.</p>
            <div class="d-grid gap-2 d-md-block">
                <a href="{{ route('employees.index') }}" class="btn btn-primary btn-lg px-5 me-md-2">Voir les Employés</a>
                <a href="#services" class="btn btn-outline-light btn-lg px-5">Découvrir</a>
            </div>
        </div>
    </header>

    <section id="services" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Nos Fonctionnalités RH</h2>
                <hr class="mx-auto bg-primary" style="width: 60px; height: 3px;">
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-feature h-100 p-4">
                        <div class="card-body text-center">
                            <div class="icon-box"><i class="fas fa-users"></i></div>
                            <h5 class="card-title fw-bold">Gestion Employés</h5>
                            <p class="card-text text-muted">Fiches détaillées, ajout, modification et suppression de vos collaborateurs.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-feature h-100 p-4">
                        <div class="card-body text-center">
                            <div class="icon-box"><i class="fas fa-sitemap"></i></div>
                            <h5 class="card-title fw-bold">Départements</h5>
                            <p class="card-text text-muted">Organisation par services pour une meilleure visibilité hiérarchique.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-feature h-100 p-4">
                        <div class="card-body text-center">
                            <div class="icon-box"><i class="fas fa-user-tag"></i></div>
                            <h5 class="card-title fw-bold">Postes & Rôles</h5>
                            <p class="card-text text-muted">Suivi précis de l'historique des postes occupés par chaque membre.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; 2026 RH-Manager. Créé pour une gestion efficace.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>