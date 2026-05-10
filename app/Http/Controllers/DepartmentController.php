<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller 
{
    /**
     * Liste tous les départements.
     */
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create() 
    {
        return view('departments.create');
    }

    /**
     * Enregistre un nouveau département.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments|max:255',
        ]);

        Department::create($request->only('name'));

        return redirect()->route('departments.index')
                         ->with('success', 'Département créé avec succès !');
    }

    /**
     * Affiche le formulaire de modification.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Met à jour le département.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            // On autorise le nom actuel du département lors de la modification
            'name' => ['required', 'max:255', Rule::unique('departments')->ignore($department->id)],
        ]);

        $department->update($request->only('name'));

        return redirect()->route('departments.index')
                         ->with('success', 'Département mis à jour !');
    }

    /**
     * Supprime un département.
     */
    public function destroy(Department $department)
    {
        // Optionnel : Vérifier si le département est vide avant de supprimer
        // if ($department->positions()->count() > 0) {
        //     return back()->with('error', 'Impossible de supprimer un département qui contient des postes.');
        // }

        $department->delete();

        return redirect()->route('departments.index')
                         ->with('success', 'Département supprimé avec succès !');
    }
}