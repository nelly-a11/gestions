        <!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Fiche Employé</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                                {{ strtoupper(substr($employee->first_name, 0, 1)) }}{{ strtoupper(substr($employee->last_name, 0, 1)) }}
                            </div>
                            <div class="ms-4">
                                <h2 class="mb-0 fw-bold">{{ $employee->first_name }} {{ $employee->last_name }}</h2>
                                <span class="badge {{ $employee->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($employee->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-6 border-bottom py-2"><strong>Email :</strong></div>
                            <div class="col-6 border-bottom py-2">{{ $employee->email }}</div>

                            <div class="col-6 border-bottom py-2"><strong>Téléphone :</strong></div>
                            <div class="col-6 border-bottom py-2">{{ $employee->phone ?? 'Non renseigné' }}</div>

                            <div class="col-6 border-bottom py-2"><strong>Département :</strong></div>
                            <div class="col-6 border-bottom py-2">{{ $employee->department->name ?? 'N/A' }}</div>

                            <div class="col-6 border-bottom py-2"><strong>Date d'embauche :</strong></div>
                            <div class="col-6 border-bottom py-2">{{ $employee->hired_at->format('d/m/Y') }}</div>
                        </div>

                        <div class="mt-5">
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</a>
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Retour à la liste</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
