<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente;
use App\Models\Tratamiento;

class ExpedienteController extends Controller
{

    public function crear_tratamiento(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:users,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'descripcion' => 'required|string|max:255',
        ]);

        $tratamiento = Tratamiento::create(
            [
                'paciente_id' => $request->paciente_id,
                'doctor_id' => $request->doctor_id,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'descripcion' => $request->descripcion,
            ]
        );

        if(!Expediente::where('paciente_id', $request->paciente_id)->exists()){
            Expediente::create([
                'tratamiento_id' => $tratamiento->id,
                'paciente_id' => $request->paciente_id,
                'fecha' => $tratamiento->created_at,
                'seguimiento' => 'Servicio con seguimiento',
            ]);
        }

        return redirect()->route('doctor.servicios', $id)->with('success', 'Servicio agregado exitosamente.');
    }

    public function ver_tratamiento($id)
    {
        $consulta = Tratamiento::where('paciente_id', $id)->get();
        return view('doctor.tratamiento', compact('consulta'));
    }

    public function ver_clientes()
    {
        $expediente = Expediente::all();
        return view('doctor.expediente', compact('expediente'));
    }
}
