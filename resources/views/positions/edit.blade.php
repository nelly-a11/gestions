@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Éditer le poste</h1>
    <form action="{{ route('positions.update', $position) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" value="{{ $position->title }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="department_id">Département</label>
            <select name="department_id" class="form-control" required>
                <option value="">Sélectionner un département</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ $position->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $position->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection