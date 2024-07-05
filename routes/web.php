<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\MedicamentoController;
use Illuminate\Support\Facades\Route;

#Menu de la parte de arriba

Route::get('/', [MenuController::class, 'welcome'])->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', [MenuController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/consulta', [MenuController::class, 'consultas'])->middleware(['auth', 'verified'])->name('consulta');

Route::get('/expediente', [MenuController::class, 'expedientes'])->middleware(['auth', 'verified'])->name('expediente');

Route::get('/medicamentos', [MenuController::class, 'medicamentos'])->middleware(['auth', 'verified'])->name('medicamentos');

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

Route::get('/pagos/{id}/edit', [PagoController::class, 'edit'])->middleware(['auth', 'verified'])->name('pago.edit');

Route::post('/pagos/{id}', [PagoController::class, 'update'])->middleware(['auth', 'verified'])->name('pago.update');

Route::get('/pagos/historial', [PagoController::class, 'historial'])->middleware(['auth', 'verified'])->name('historial');

#doctores

Route::get('/consulta', [ConsultaController::class, 'consulta'])->middleware(['auth', 'verified'])->name('consulta');

Route::get('/consulta/realizar/{id}', [ConsultaController::class, 'realizar'])->middleware(['auth', 'verified'])->name('doctor.realizarcita');

Route::get('consulta/realizar/{id}/servicio', [ConsultaController::class, 'tratamiento'])->middleware(['auth', 'verified'])->name('doctor.servicios');

#Expedientes & Tratamientos

Route::post('consulta/realizar/{id}/servicio/tratamiento', [ExpedienteController::class, 'crear_tratamiento'])->middleware(['auth', 'verified'])->name('tratamiento');

Route::delete('/expediente/servicios/{id}/destroy/', [ExpedienteController::class, 'destroy_tratamiento'])->name('destroy.tratamiento');

Route::get('/expediente', [ExpedienteController::class, 'ver_clientes'])->middleware(['auth', 'verified'])->name('expediente');

Route::get('/expediente/servicios/{id}', [ExpedienteController::class, 'ver_tratamiento'])->middleware(['auth', 'verified'])->name('doctor.expediente');

#Medicamento

Route::get('/medicamentos', [MedicamentoController::class, 'ver_productos'])->middleware(['auth', 'verified'])->name('medicamentos');

Route::get('/agregar_medicamento', [MedicamentoController::class, 'registrar_producto'])->middleware(['auth', 'verified'])->name('agregar_medicamento');

Route::get('/editar_medicamento/{id}', [MedicamentoController::class, 'editar_producto'])->middleware(['auth', 'verified'])->name('editar.medicamento');

Route::post('/editar_medicamento/{id}/edit', [MedicamentoController::class, 'modificar_producto'])->middleware(['auth', 'verified'])->name('modificar.medicamento');

Route::delete('/medicamentos/{id}/destroy/', [MedicamentoController::class, 'destroy_tratamiento'])->middleware(['auth', 'verified'])->name('destroy.medicamento');

Route::post('/agregar_medicamento/add', [MedicamentoController::class, 'agregar_producto'])->middleware(['auth', 'verified'])->name('agregar.medicamento');

#------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
