@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0 overflow-hidden">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Ajouter un Nouvel Employé</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf
                        
                        <h6 class="text-primary border-bottom pb-2 mb-3">Informations Personnelles</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nom</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="Nom de famille" required>
                                </div>
                                @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Prénom</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="Prénom" required>
                                @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email Professionnel</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="email@entreprise.com" required>
                                </div>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Téléphone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="+237..." required>
                                </div>
                                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <h6 class="text-primary border-bottom pb-2 mt-4 mb-3">Affectation et Contrat</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Département</label>
                                <select name="department_id" class="form-select @error('department_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>Choisir un département</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                            {{ $dept->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Poste / Fonction</label>
                                <select name="position_id" class="form-select @error('position_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>Attribuer un poste</option>
                                    @foreach($positions as $pos)
                                        <option value="{{ $pos->id }}" {{ old('position_id') == $pos->id ? 'selected' : '' }}>
                                            {{ $pos->title }} </option>
                                    @endforeach
                                </select>
                                @error('position_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Date d'embauche</label>
                                <input type="date" name="hired_at" value="{{ old('hired_at') }}" class="form-control @error('hired_at') is-invalid @enderror" required>
                                @error('hired_at') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Statut Initial</label>
                                <select name="status" class="form-select" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Actif</option>
                                    <option value="on_leave" {{ old('status') == 'on_leave' ? 'selected' : '' }}>En congé</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactif</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                <i class="fas fa-save me-2"></i>Enregistrer l'employé
                            </button>
                            <a href="{{ route('employees.index') }}" class="btn btn-light px-4 border">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card { border-radius: 12px; }
    .form-label { color: #495057; font-size: 0.9rem; }
    .input-group-text { background-color: #f8f9fa; color: #6c757d; }
    .form-control:focus, .form-select:focus { 
        border-color: #0d6efd; 
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1); 
    }
</style>
@endsection