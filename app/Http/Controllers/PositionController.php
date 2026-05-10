<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Department;
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
    // 1. On récupère les postes (avec leur département et le nombre d'employés)
    $positions = Position::with('department')
        ->withCount('employees')
        ->latest()
        ->get();

    // 2. ON RÉCUPÈRE LES DÉPARTEMENTS (C'est la ligne qui manquait !)
    $departments = \App\Models\Department::all(); 

    // 3. On envoie les DEUX variables à la vue
    return view('positions.index', compact('positions', 'departments'));
}

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $departments = Department::orderBy('name')->get();
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

        Position::create($validated);

        return redirect()
            ->route('positions.index')
            ->with('success', 'Le poste "' . $request->title . '" a été créé avec succès.');
    }

    /**
     * Détails d'un poste et liste des employés concernés.
     */
    public function show(Position $position)
{
    $employees = $position->employees; // Récupère les employés via la relation
    return view('positions.show', compact('position', 'employees'));
}

    /**
     * Formulaire d'édition.
     */
    public function edit(Position $position)
    {
        $departments = Department::orderBy('name')->get();
        return view('positions.edit', compact('position', 'departments'));
    }

    /**
     * Mise à jour du poste.
     */
    public function update(Request $request, Position $position) {
    // 1. On valide
    $validated = $request->validate([
        'title' => 'required|max:100',
        'department_id' => 'required|exists:departments,id',
        'description' => 'nullable|string',
    ]);

    // 2. On essaie de mettre à jour
    $success = $position->update($request->all());

    // 3. SI CA NE MARCHE PAS, ON FORCE L'ERREUR
    if (!$success) {
        dd("Le modèle refuse de se mettre à jour. Vérifie le fillable dans Position.php");
    }

    return redirect()->route('positions.index')->with('success', 'Poste mis à jour !');
}

    /**
     * Suppression d'un poste.
     */
    public function destroy(Position $position)
    {
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