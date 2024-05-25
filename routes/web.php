<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MenuController::class, 'welcome'])->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', [MenuController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pacientes', [PacienteController::class, 'paciente'])->middleware(['auth', 'verified'])->name('paciente');

Route::get('/pagos', [MenuController::class, 'pago'])->middleware(['auth', 'verified'])->name('pago');

Route::get('/pacientes/registrar_pacientes', [PacienteController::class, 'registrar_paciente'])->middleware(['auth', 'verified'])->name('registrar_paciente');

Route::post('/pacientes', [PacienteController::class, 'registro_paciente'])->name('registro_paciente');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
