@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="fas fa-briefcase text-primary me-2"></i>Poste : {{ $position->title }}
        </h2>
        <a href="{{ route('positions.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Retour à la liste
        </a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-dark text-white fw-bold py-3">
                    <i class="fas fa-info-circle me-1"></i> Fiche technique
                </div>
                <div class="card-body">
                    <label class="text-muted small text-uppercase fw-bold">Département</label>
                    <p class="fs-5 fw-bold">{{ $position->department->name ?? 'Non assigné' }}</p>
                    
                    <label class="text-muted small text-uppercase fw-bold">Description</label>
                    <p class="text-secondary small">
                        {{ $position->description ?: 'Aucune description fournie pour ce poste.' }}
                    </p>

                    <hr>

                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning fw-bold">
                            <i class="fas fa-edit me-1"></i> Modifier le poste
                        </a>
                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Attention : Tous les employés liés à ce poste perdront cette affectation. Confirmer la suppression ?')">
                                <i class="fas fa-trash me-1"></i> Supprimer le poste
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-primary text-white fw-bold py-3 d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-users me-1"></i> Collaborateurs ({{ $employees->count() }})</span>
                    <a href="{{ route('employees.create') }}" class="btn btn-light btn-sm fw-bold">+ Ajouter</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Nom complet</th>
                                    <th>Email</th>
                                    <th>Statut</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($employees as $employee)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold">{{ $employee->first_name }} {{ $employee->last_name }}</div>
                                        <small class="text-muted">Engagé le {{ $employee->hired_at ? $employee->hired_at->format('d/m/Y') : 'N/A' }}</small>
                                    </td>
                                    <td>{{ $employee->email }}</td>
                                    <td>
                                        <span class="badge {{ $employee->status == 'active' ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                                            {{ $employee->status == 'active' ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-light border text-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-slash fa-3x mb-3 d-block opacity-25"></i>
                                        Aucun employé n'occupe ce poste.
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
</div>
@endsection