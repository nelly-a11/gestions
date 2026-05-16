<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * Liste des postes avec leurs départements et le nombre d'employés.
     */
    public function index()
    {
        // On vérifie d'abord si la classe existe pour éviter le crash fatal
        if (!class_exists('\App\Models\Position')) {
            abort(500, "Le modèle App\Models\Position est introuvable. Vérifiez la casse du fichier.");
        }

        // 1. On récupère les postes (avec leur département et le nombre d'employés)
        $positions = \App\Models\Position::with('department')
            ->withCount('employees')
            ->latest()
            ->get();

        // 2. On récupère les départements
        $departments = \App\Models\Department::all(); 

        // 3. On envoie les deux variables à la vue
        return view('positions.index', compact('positions', 'departments'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $departments = \App\Models\Department::orderBy('name')->get();
        return view('positions.create', compact('departments'));
    }

    /**
     * Enregistrement d'un nouveau poste.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:100|unique:positions,title',
            'department_id' => 'required|exists:departments,id',
            'description'   => 'nullable|string|max:500',
        ]);

        \App\Models\Position::create($validated);

        return redirect()
            ->route('positions.index')
            ->with('success', 'Le poste "' . $request->title . '" a été créé avec succès.');
    }

    /**
     * Détails d'un poste et liste des employés concernés.
     */
    public function show($id)
    {
        $position = \App\Models\Position::findOrFail($id);
        $employees = $position->employees; 
        
        return view('positions.show', compact('position', 'employees'));
    }

    /**
     * Formulaire d'édition.
     */
    public function edit($id)
    {
        $position = \App\Models\Position::findOrFail($id);
        $departments = \App\Models\Department::orderBy('name')->get();
        
        return view('positions.edit', compact('position', 'departments'));
    }

    /**
     * Mise à jour du poste.
     */
    public function update(Request $request, $id) 
    {
        $position = \App\Models\Position::findOrFail($id);

        // 1. On valide
        $validated = $request->validate([
            'title' => 'required|max:100',
            'department_id' => 'required|exists:departments,id',
            'description' => 'nullable|string',
        ]);

        // 2. On essaie de mettre à jour
        $success = $position->update($validated);

        // 3. Si ça ne marche pas, protection fillable
        if (!$success) {
            dd("Le modèle refuse de se mettre à jour. Vérifie le fillable dans Position.php");
        }

        return redirect()->route('positions.index')->with('success', 'Poste mis à jour !');
    }

    /**
     * Suppression d'un poste.
     */
    public function destroy($id)
    {
        $position = \App\Models\Position::findOrFail($id);

        // Vérification de sécurité : ne pas supprimer si le poste est occupé
        if ($position->employees()->count() > 0) {
            return redirect()
                ->route('positions.index')
                ->with('error', 'Impossible de supprimer ce poste car il contient encore des employés.');
        }

        $position->delete();

        return redirect()
            ->route('positions.index')
            ->with('danger', 'Le poste a été définitivement supprimé.');
    }
}