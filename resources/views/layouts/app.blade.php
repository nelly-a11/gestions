<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RH Pro | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .sidebar { width: 250px; height: 100vh; position: fixed; background: #2c3e50; color: white; transition: all 0.3s; }
        .sidebar .nav-link { color: rgba(255,255,255,0.7); padding: 15px 25px; font-weight: 500; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background: rgba(255,255,255,0.1); border-left: 4px solid #3498db; }
        .main-content { margin-left: 250px; padding: 30px; }
        .navbar-custom { background: white; box-shadow: 0 2px 15px rgba(0,0,0,0.05); padding: 15px 30px; }
        .card-stats { border: none; border-radius: 15px; transition: transform 0.3s; }
        .card-stats:hover { transform: translateY(-5px); }
        .icon-shape { width: 48px; height: 48px; background: #e9ecef; display: flex; align-items: center; justify-content: center; border-radius: 12px; }
    </style>
</head>
<body>

    <div class="sidebar shadow">
        <div class="p-4 text-center">
            <h4 class="fw-bold text-white"><i class="fas fa-user-tie me-2"></i>RH<span class="text-info">PRO</span></h4>
            <hr class="text-secondary">
        </div>
        <nav class="nav flex-column">
            <a class="nav-link active" href="{{ route('dashboard') }}"><i class="fas fa-chart-line me-2"></i> Vue d'ensemble</a>
            <a class="nav-link" href="{{ route('positions.index') }}"><i class="fas fa-briefcase me-2"></i> Gestion des Postes</a>
            <a class="nav-link" href="#"><i class="fas fa-users me-2"></i> Employés</a>
            <a class="nav-link" href="departments"><i class="fas fa-building me-2"></i> Départements</a>
            <a class="nav-link mt-5 text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i> Déconnexion</a>
        </nav>
    </div>

    <div class="main-content">
        <nav class="navbar navbar-custom rounded-4 mb-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark">Tableau de Bord</h5>
            <div class="dropdown">
                <img src="https://ui-avatars.com/api/?name=Admin+RH&background=3498db&color=fff" class="rounded-circle shadow-sm" width="40" alt="Avatar">
                <span class="ms-2 fw-medium">Administrateur</span>
            </div>
        </nav>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>