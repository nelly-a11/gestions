<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// --- ROUTES API PROTÉGÉES ---
Route::middleware('auth:sanctum')->group(function () {
    
    // En ajoutant ->names('api.X'), Laravel génèrera 'api.employees.index', etc.
    // Plus aucun conflit possible avec les routes web !
    Route::apiResource('employees', EmployeeController::class)->names('api.employees');
    Route::apiResource('departments', DepartmentController::class)->names('api.departments');
    Route::apiResource('positions', PositionController::class)->names('api.positions');
    Route::apiResource('users', UserController::class)->names('api.users');
    
});