<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\EquipmentMovementController;
use App\Http\Controllers\DepartmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Protected routes with authentication
Route::middleware(['auth'])->group(function () {
    // Resources accessible to all authenticated users
    Route::resource('visitors', VisitorController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('contractors', ContractorController::class);
    Route::resource('equipment_movements', EquipmentMovementController::class);

    // Admin and Supervisor only
    Route::middleware('role:Admin,Supervisor')->group(function () {
        Route::get('/reports/pdf', [DashboardController::class, 'exportPdf'])->name('reports.pdf');
        Route::get('/reports/excel', [DashboardController::class, 'exportExcel'])->name('reports.excel');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
