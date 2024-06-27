<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ConsultaController extends Controller
{   

    public function realizar($id)
    {
        $consulta = Cita::findOrFail($id);
        return view('doctor.realizarcita', compact('consulta'));
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

    public function tratamiento($id){
        if (auth()->user()->tipo === 'doctor') {
            $item = Cita::findOrFail($id);
            return view('doctor.servicios', compact('item'));
        }
    }
}
