<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

#Menu de la parte de arriba

Route::get('/', [MenuController::class, 'welcome'])->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', [MenuController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pagos', [MenuController::class, 'pago'])->middleware(['auth', 'verified'])->name('pago');

#Pestaña de pacientes

Route::get('/pacientes/registrar_pacientes', [PacienteController::class, 'registrar_paciente'])->middleware(['auth', 'verified'])->name('registrar_paciente');

Route::post('/pacientes', [PacienteController::class, 'registro_paciente'])->middleware(['auth', 'verified'])->name('registro_paciente');

Route::get('/pacientes/{id}/edit', [PacienteController::class, 'edit'])->middleware(['auth', 'verified'])->name('paciente.edit');

Route::get('/pacientes/{id}/destroy', [PacienteController::class, 'paciente_eliminar'])->middleware(['auth', 'verified'])->name('paciente.destroy');

Route::resource('paciente', PacienteController::class);

Route::get('/pacientes', [PacienteController::class, 'paciente'])->middleware(['auth', 'verified'])->name('paciente');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
