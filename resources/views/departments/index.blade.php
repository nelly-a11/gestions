@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h1 class="fw-bold text-dark border-start border-primary border-5 ps-3">Départements</h1>
            <p class="text-muted ms-4">Gestion de la structure organisationnelle</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('departments.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
                <i class="fas fa-plus me-2"></i>Nouveau Département
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 ps-4 text-uppercase small fw-bold text-secondary" style="width: 10%">ID</th>
                        <th class="py-3 text-uppercase small fw-bold text-secondary" style="width: 45%">Nom du Département</th>
                        <th class="py-3 text-center text-uppercase small fw-bold text-secondary" style="width: 20%">Effectif</th>
                        <th class="py-3 pe-4 text-center text-uppercase small fw-bold text-secondary" style="width: 25%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departments as $department)
                    <tr>
                        <td class="ps-4">
                            <span class="badge bg-soft-secondary text-dark">#{{ $department->id }}</span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; font-weight: bold;">
                                    {{ strtoupper(substr($department->name, 0, 1)) }}
                                </div>
                                <span class="fw-bold">{{ $department->name }}</span>
                            </div>
                        </td>

                        <td class="text-center">
                            <div class="d-inline-flex align-items-center px-3 py-1 rounded-pill bg-light border">
                                <i class="fas fa-users text-primary me-2 small"></i>
                                <span class="fw-bold">{{ $department->employees_count ?? 0 }}</span>
                            </div>
                        </td>

                        <td class="text-center pe-4">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('departments.show', $department) }}" class="btn btn-sm btn-outline-info rounded-3" title="Détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-outline-warning rounded-3" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" onclick="return confirm('Supprimer ce département ?')" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <img src="https://illustrations.popsy.co/gray/box.svg" alt="Vide" style="width: 150px;" class="mb-3">
                            <p class="text-muted">Aucun département trouvé.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    body { background-color: #f8f9fa; }
    
    .card { border-radius: 12px; }
    
    .bg-soft-secondary { background-color: #e9ecef; }
    
    /* Animation au survol */
    .table tbody tr { transition: 0.2s ease-in-out; }
    .table tbody tr:hover { background-color: #f2f5ff !important; }

    /* Style des boutons d'action */
    .btn-sm {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }
    
    .btn-sm:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Avatar circulaire */
    .avatar-sm {
        font-size: 0.9rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection