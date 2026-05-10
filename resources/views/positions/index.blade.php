@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 overflow-hidden">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i>Nouveau Poste</h5>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger p-2 small border-0 shadow-sm">
                            <ul class="mb-0 fs-7">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('positions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Intitulé du poste</label>
                            <input type="text" name="title" class="form-control" placeholder="Ex: Analyste Développeur" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Département</label>
                            <select name="department_id" class="form-select select-required" required>
                                <option value="" selected disabled>Choisir un département...</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Description courte (optionnelle)">{{ old('description') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 fw-bold">
                            <i class="fas fa-save me-2"></i>Créer le poste
                        </button>
                    </form>
                </div>
            </div>
            
            <a href="{{ route('dashboard') }}" class="btn btn-light border mt-3 w-100">
                <i class="fas fa-tachometer-alt me-2 text-primary"></i>Retour au Dashboard
            </a>
        </div>

        <div class="col-md-8">
            <div class="card shadow border-0 overflow-hidden">
                <div class="card-body p-0">
                    <div class="px-4 pt-4 pb-3">
                        <h4 class="fw-bold mb-0 text-dark">Catalogue des Postes</h4>
                        <p class="text-muted small mb-0">Liste de tous les postes définis dans l'entreprise</p>
                    </div>
                    
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mx-4 mt-2">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger border-0 shadow-sm mx-4 mt-2">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    <table class="table table-hover align-middle custom-table">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Poste</th>
                                <th>Département</th>
                                <th class="text-center">Effectif</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($positions as $pos)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-primary">{{ $pos->title }}</div>
                                    <small class="text-muted">{{ Str::limit($pos->description, 30, '...') }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-soft-info text-dark border">
                                        {{ $pos->department->name ?? 'Non assigné' }}
                                    </span>
                                </td>
                                <td class="text-center fw-bold">
                                    {{ $pos->employees_count }}
                                </td>
                                <td class="text-end pe-4 action-cell">
                                    <div class="btn-group gap-1">
                                        <a href="{{ route('positions.show', $pos->id) }}" class="btn btn-view btn-sm" title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('positions.edit', $pos->id) }}" class="btn btn-edit btn-sm" title="Modifier">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('positions.destroy', $pos->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-delete btn-sm" title="Supprimer" onclick="return confirm('Confirmer la suppression ?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="fas fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted fs-5 mb-0">Aucun poste défini.</p>
                                    <p class="text-muted small">Utilisez le formulaire à gauche pour en créer un.</p>
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

<style>
    /* Configuration globale */
    body {
        background-color: #f6f8fa;
    }
    .card {
        border-radius: 12px;
    }
    
    /* Titres des tables */
    .custom-table thead th {
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.8px;
        color: #6c757d;
        padding-top: 15px;
        padding-bottom: 15px;
    }
    
    /* Cellules */
    .custom-table tbody td {
        padding-top: 18px;
        padding-bottom: 18px;
        color: #495057;
    }
    
    /* Badges */
    .bg-soft-info {
        background-color: #e3f2fd;
    }
    
    /* Boutons d'action */
    .btn-sm {
        border-radius: 6px;
        padding: 5px 10px;
    }
    .btn-view { color: #0d6efd; background-color: #e9ecef; }
    .btn-view:hover { background-color: #0d6efd; color: white; }
    
    .btn-edit { color: #f59e0b; background-color: #e9ecef; }
    .btn-edit:hover { background-color: #f59e0b; color: white; }
    
    .btn-delete { color: #dc3545; background-color: #e9ecef; }
    .btn-delete:hover { background-color: #dc3545; color: white; }
    
    /* Hover sur les lignes */
    .table-hover tbody tr:hover {
        background-color: #fcfdfe;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection