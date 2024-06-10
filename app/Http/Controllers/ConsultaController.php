<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Tratamiento;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ConsultaController extends Controller
{

    public function crear_tratamiento(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'paciente_id' => 'required|string|max:255',
            'doctor_id' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'descripcion' => 'required|string|max:255',
        ]);
    
        Tratamiento::create($validatedData);
        return  response()->json(['message' => 'Datos recibidos correctamente']);
    }

    public function realizar($id)
    {
        $consulta = Cita::findOrFail($id);
        return view('doctor.realizarcita', compact('consulta'));
    }

    public function ver_tratamiento()
    {
        $consulta = Tratamiento::all();
        return view('doctor.tratamiento', compact('consulta'));
    }

    public function agendar_cita()
    {
        if (auth()->user()->tipo === 'doctor') {
            $pacientes = Paciente::all();
            $doctores = User::where('tipo', 'doctor')->get();
            return view('cita.agendar', compact('pacientes', 'doctores'));
        }
    }

    public function consulta(){
        if (auth()->user()->tipo === 'doctor') {
            $consultas = Cita::where('doctor_id', auth()->user()->id)->get();
            return view('doctor.consulta', compact('consultas'));
        }
    }
}
