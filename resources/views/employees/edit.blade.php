<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Modifier l'Employé</title>
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-warning text-dark fw-bold py-3">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Modifier le profil de : {{ $employee->first_name }} {{ $employee->last_name }}</h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Nom</label>
                                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $employee->last_name) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Prénom</label>
                                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $employee->first_name) }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Téléphone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-primary">Département</label>
                                    <select name="department_id" class="form-select border-primary" required>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}" {{ $employee->department_id == $dept->id ? 'selected' : '' }}>
                                                {{ $dept->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-primary">Poste / Fonction</label>
                                    <select name="position_id" class="form-select border-primary" required>
                                        @foreach($positions as $pos)
                                            <option value="{{ $pos->id }}" {{ $employee->position_id == $pos->id ? 'selected' : '' }}>
                                                {{ $pos->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Date d'embauche</label>
                                    <input type="date" name="hired_at" class="form-control" value="{{ $employee->hired_at->format('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Statut</label>
                                    <select name="status" class="form-select">
                                        <option value="active" {{ $employee->status == 'active' ? 'selected' : '' }}>Actif</option>
                                        <option value="on_leave" {{ $employee->status == 'on_leave' ? 'selected' : '' }}>En congé</option>
                                        <option value="inactive" {{ $employee->status == 'inactive' ? 'selected' : '' }}>Inactif</option>
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <div class="mt-4 d-flex justify-content-between">
                                <a href="{{ route('employees.index') }}" class="btn btn-secondary px-4">
                                    <i class="fas fa-times me-1"></i> Annuler
                                </a>
                                <button type="submit" class="btn btn-warning px-5 fw-bold shadow-sm">
                                    <i class="fas fa-save me-1"></i> Mettre à jour les informations
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3 text-muted small">
                    Note : Toute modification du poste générera automatiquement une entrée dans l'historique de carrière.
                </p>
            </div>
        </div>
    </div>
</body>
</html>