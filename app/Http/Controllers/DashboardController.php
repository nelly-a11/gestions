<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        // 1. On récupère les compteurs simples
        $totalEmployees = Employee::count();
        $totalDepartments = Department::count();

        // 2. On récupère les 5 derniers employés AVEC leur département
        // IMPORTANT : Le nom de la variable ici doit correspondre à celui de la vue (recentEmployees)
        $recentEmployees = Employee::with('department')
                                    ->latest()
                                    ->take(5)
                                    ->get();

        // 3. On envoie tout à la vue
        return view('dashboard', compact(
            'totalEmployees', 
            'totalDepartments', 
            'recentEmployees'
        ));
    }
}