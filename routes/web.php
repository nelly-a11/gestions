<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- ROUTES PUBLIQUES ---
Route::get('/', function () {
    return view('welcome'); 
})->name('welcome');

// Authentification
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- ROUTES PROTÉGÉES (Middleware Auth) ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Ressources RH (Noms sécurisés pour le cache Laravel)
    Route::resource('employees', EmployeeController::class)->names([
        'index' => 'employees.index'
    ]);
    
    Route::resource('departments', DepartmentController::class)->names([
        'index' => 'departments.index'
    ]);
    
    Route::resource('positions', PositionController::class)->names([
        'index' => 'positions.index'
    ]);

    // Administration
    Route::resource('users', UserController::class)->names([
        'index' => 'users.index'
    ]);

});