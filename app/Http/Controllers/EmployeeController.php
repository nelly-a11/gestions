<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;

class EmployeeController extends Controller
{
    /**
     * Liste des employés avec pagination et chargement des relations.
     */
    public function index()
    {
        // On vérifie que les modèles existent pour éviter un crash d'autoloader
        if (!class_exists('\App\Models\Employee')) {
            abort(500, "Le modèle App\Models\Employee est introuvable.");
        }

        // On récupère les relations pour éviter les requêtes inutiles (N+1)
        $employees = \App\Models\Employee::with(['department', 'position'])->latest()->paginate(10);
        
        return view('employees.index', compact('employees'));
    }

    /**
     * Formulaire de création d'un employé.
     */
    public function create()
    {
        $positions = class_exists('\App\Models\Position') ? \App\Models\Position::all() : collect();
        $departments = class_exists('\App\Models\Department') ? \App\Models\Department::all() : collect(); 
        
        return view('employees.create', compact('positions', 'departments'));
    }

    /**
     * Enregistrement d'un nouvel employé et de son premier historique.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:employees,email',
            'phone'         => 'required|string|max:50',
            'department_id' => 'required|exists:departments,id',
            'position_id'   => 'required|exists:positions,id',
            'hired_at'      => 'required|date',
            'status'        => 'required|in:active,inactive'
        ]);

        // 1. Création de l'employé
        $employee = \App\Models\Employee::create($request->all());

        // 2. Création du premier historique de poste
        if ($employee && method_exists($employee, 'histories')) {
            $employee->histories()->create([
                'position_id' => $request->position_id,
                'start_date'  => $request->hired_at,
            ]);
        }

        return redirect()->route('employees.index')->with('success', 'Employé et historique créés avec succès !');
    }

    /**
     * Affichage des détails d'un employé.
     */
    public function show($id)
    {
        $employee = \App\Models\Employee::findOrFail($id);
        $employee->load(['department', 'position', 'histories.position']);
        
        return view('employees.show', compact('employee'));
    }

    /**
     * Formulaire d'édition d'un employé.
     */
    public function edit($id)
    {
        $employee = \App\Models\Employee::findOrFail($id);
        $departments = class_exists('\App\Models\Department') ? \App\Models\Department::all() : collect();
        $positions = class_exists('\App\Models\Position') ? \App\Models\Position::all() : collect();
        
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * Mise à jour des informations de l'employé et de son historique de carrière.
     */
    public function update(Request $request, $id)
    {
        $employee = \App\Models\Employee::findOrFail($id);

        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:employees,email,' . $employee->id,
            'department_id' => 'required|exists:departments,id',
            'position_id'   => 'required|exists:positions,id',
            'hired_at'      => 'required|date',
            'status'        => 'required|in:active,inactive'
        ]);

        // LOGIQUE D'HISTORIQUE : Si le poste change
        if ($employee->position_id != $request->position_id && method_exists($employee, 'histories')) {
            // On ferme l'ancien poste
            $employee->histories()->whereNull('end_date')->update(['end_date' => now()]);

            // On ouvre le nouveau poste
            $employee->histories()->create([
                'position_id' => $request->position_id,
                'start_date'  => now(),
            ]);
        }

        $employee->update($request->all());

        // FIX : L'apostrophe a été échappée ici (\') pour éviter l'erreur de syntaxe
        return redirect()->route('employees.index')->with('success', 'Profil de l\'employé mis à jour !');
    }

    /**
     * Suppression d'un employé.
     */
    public function destroy($id)
    {
        $employee = \App\Models\Employee::findOrFail($id);
        $employee->delete();
        
        return redirect()->route('employees.index')->with('success', 'Employé supprimé avec succès.');
    }
}