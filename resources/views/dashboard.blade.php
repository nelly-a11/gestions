<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | RH Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #212529; color: white; }
        .nav-link { color: rgba(255,255,255,0.8); border-radius: 8px; margin: 5px 0; }
        .nav-link:hover, .nav-link.active { background: #0d6efd; color: white; }
        .stat-card { border: none; border-radius: 15px; transition: transform 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
        .icon-shape { width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; border-radius: 12px; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-3 shadow">
            <h4 class="text-center fw-bold mb-4 mt-2 text-primary"><i class="fas fa-chart-pie me-2"></i>RH Pro</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employees.index') }}"><i class="fas fa-users me-2"></i> Employés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('departments.index') }}"><i class="fas fa-sitemap me-2"></i> Départements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('positions.index') }}"><i class="fas fa-user-tag me-2"></i> Postes</a>
                </li>
                <hr class="text-secondary">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link w-100 text-start text-danger border-0">
                            <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 fw-bold">Tableau de Bord</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <span class="badge bg-primary p-2 shadow-sm">Bienvenue, {{ Auth::user()->name }}</span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card stat-card shadow-sm p-3 border-start border-primary border-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-uppercase font-weight-bold text-muted">Total Employés</p>
                                <h4 class="fw-bold mb-0">{{ $totalEmployees ?? 0 }}</h4>
                            </div>
                            <div class="icon-shape bg-primary text-white shadow"><i class="fas fa-user-friends"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card stat-card shadow-sm p-3 border-start border-success border-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-uppercase font-weight-bold text-muted">Départements</p>
                                <h4 class="fw-bold mb-0">{{ $totalDepartments ?? 0 }}</h4>
                            </div>
                            <div class="icon-shape bg-success text-white shadow"><i class="fas fa-building"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card stat-card shadow-sm p-3 border-start border-info border-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-uppercase font-weight-bold text-muted">Nouveaux</p>
                                <h4 class="fw-bold mb-0">+{{ isset($recentEmployees) ? $recentEmployees->count() : 0 }}</h4>
                            </div>
                            <div class="icon-shape bg-info text-white shadow"><i class="fas fa-user-plus"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card stat-card shadow-sm p-3 border-start border-warning border-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-uppercase font-weight-bold text-muted">Postes Définis</p>
                                <h4 class="fw-bold mb-0">
                                    @if(class_exists('App\Models\Position'))
                                        {{ \App\Models\Position::count() }}
                                    @else
                                        0
                                    @endif
                                </h4>
                            </div>
                            <div class="icon-shape bg-warning text-white shadow"><i class="fas fa-briefcase"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Hires Table -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-history me-2 text-primary"></i>Dernières Embauches</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle table-hover">
                                    <thead class="bg-light text-secondary small text-uppercase">
                                        <tr>
                                            <th>Employé</th>
                                            <th>Département</th>
                                            <th>Date d'entrée</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentEmployees ?? [] as $emp)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded-circle p-2 me-2 text-center" style="width: 35px">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                    <strong>{{ $emp->first_name ?? 'N/A' }} {{ $emp->last_name ?? '' }}</strong>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">
                                                    {{ $emp->department->name ?? 'Non assigné' }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $emp->hired_at ? $emp->hired_at->format('d/m/Y') : 'Inconnue' }}
                                            </td>
                                            <td>
                                                @php $status = $emp->status ?? 'inactive'; @endphp
                                                <span class="badge {{ $status == 'active' ? 'bg-success' : ($status == 'on_leave' ? 'bg-warning' : 'bg-danger') }}">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">
                                                <i class="fas fa-users-slash fa-2x mb-3 d-block"></i>
                                                Aucun employé trouvé pour le moment.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>