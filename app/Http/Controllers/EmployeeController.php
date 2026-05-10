<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position; 
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // On récupère les relations pour éviter les requêtes inutiles (N+1)
        $employees = Employee::with(['department', 'position'])->latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        // CORRECTION : Il faut envoyer les DEUX variables pour le formulaire
        $positions = Position::all();
        $departments = Department::all(); 
        
        return view('employees.create', compact('positions', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:employees',
            'phone'         => 'required',
            'department_id' => 'required|exists:departments,id',
            'position_id'   => 'required|exists:positions,id',
            'hired_at'      => 'required|date',
            'status'        => 'required|in:active,on_leave,inactive'
        ]);

        // 1. Création de l'employé
        $employee = Employee::create($request->all());

        // 2. Création du premier historique de poste
        // Vérifie que la relation "histories()" existe dans ton modèle Employee
        $employee->histories()->create([
            'position_id' => $request->position_id,
            'start_date'  => $request->hired_at,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employé et historique créés !');
    }

    public function show(Employee $employee) 
    {
        $employee->load(['department', 'position', 'histories.position']);
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:employees,email,'.$employee->id,
            'department_id' => 'required|exists:departments,id',
            'position_id'   => 'required|exists:positions,id',
            'hired_at'      => 'required|date',
            'status'        => 'required|in:active,on_leave,inactive'
        ]);

        // LOGIQUE D'HISTORIQUE : Si le poste change
        if ($employee->position_id != $request->position_id) {
            // On ferme l'ancien poste
            $employee->histories()->whereNull('end_date')->update(['end_date' => now()]);

            // On ouvre le nouveau poste
            $employee->histories()->create([
                'position_id' => $request->position_id,
                'start_date'  => now(),
            ]);
        }

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Profil mis à jour !');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employé supprimé.');
    }
}