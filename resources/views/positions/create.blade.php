@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un poste</h1>
    <form action="{{ route('positions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="department_id">Département</label>
            <select name="department_id" class="form-control" required>
                <option value="">Sélectionner un département</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection