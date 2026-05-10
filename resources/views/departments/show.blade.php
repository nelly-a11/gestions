@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Département : {{ $department->name }}</h1>
    <p><strong>ID :</strong> {{ $department->id }}</p>
    <p><strong>Créé le :</strong> {{ $department->created_at }}</p>
    <h2>Employés ({{ $department->employees->count() }})</h2>
    <ul>
        @foreach($department->employees as $employee)
        <li>{{ $employee->name }} - {{ $employee->position->title ?? 'N/A' }}</li>
        @endforeach
    </ul>
    <h2>Postes ({{ $department->positions->count() }})</h2>
    <ul>
        @foreach($department->positions as $position)
        <li>{{ $position->title }}</li>
        @endforeach
    </ul>
    <a href="{{ route('departments.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection