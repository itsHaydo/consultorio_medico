<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagoController;
use Illuminate\Support\Facades\Route;

#Menu de la parte de arriba

Route::get('/', [MenuController::class, 'welcome'])->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', [MenuController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/consulta', [MenuController::class, 'consultas'])->middleware(['auth', 'verified'])->name('consulta');

Route::get('/expediente', [MenuController::class, 'expedientes'])->middleware(['auth', 'verified'])->name('expediente');



#Pestaña de pacientes

Route::get('/pacientes/registrar_pacientes', [PacienteController::class, 'registrar_paciente'])->middleware(['auth', 'verified'])->name('registrar_paciente');

Route::post('/pacientes', [PacienteController::class, 'registro_paciente'])->middleware(['auth', 'verified'])->name('registro_paciente');

Route::get('/pacientes/{id}/edit', [PacienteController::class, 'edit'])->middleware(['auth', 'verified'])->name('paciente.edit');

Route::get('/pacientes/{id}/destroy', [PacienteController::class, 'paciente_eliminar'])->middleware(['auth', 'verified'])->name('paciente.destroy');

Route::resource('paciente', PacienteController::class);

Route::get('/pacientes', [PacienteController::class, 'paciente'])->middleware(['auth', 'verified'])->name('paciente');

#citas

Route::get('/citas',[CitaController::class, 'cita'])->middleware(['auth', 'verified'])->name('cita');

Route::get('/cita/agendar',[CitaController::class, 'agendar_cita'])->middleware(['auth', 'verified'])->name('agendar_cita');

Route::get('/cita/agandar', [CitaController::class, 'create'])->middleware(['auth', 'verified'])->name('cita.agendar');

Route::post('/cita', [CitaController::class, 'store'])->middleware(['auth', 'verified'])->name('cita.store');

Route::get('/cita/{id}/edit', [CitaController::class, 'edit'])->middleware(['auth', 'verified'])->name('cita.edit');

#pagos 

Route::get('/pagos', [PagoController::class, 'pago'])->middleware(['auth', 'verified'])->name('pago');

Route::get('/pagos/{id}/edit', [PagoController::class, 'edit'])->name('pago.edit');

Route::post('/pagos/{id}', [PagoController::class, 'update'])->name('pago.update');

Route::get('/pagos/historial', [PagoController::class, 'historial'])->middleware(['auth', 'verified'])->name('historial');

#doctores

Route::get('/consulta', [ConsultaController::class, 'consulta'])->middleware(['auth', 'verified'])->name('consulta');

Route::get('/consulta/realizar/{id}', [ConsultaController::class, 'realizar'])->middleware(['auth', 'verified'])->name('doctor.realizarcita');



#------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
