<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ConsultaController extends Controller
{

    public function realizar($id)
    {
        $consulta = Cita::findOrFail($id);
        return view('doctor.realizarcita', compact('consulta'));
    }

    public function consulta(){
        if (auth()->user()->tipo === 'doctor') {
            $consultas = Cita::where('doctor_id', auth()->user()->id)->get();
            return view('doctor.consulta', compact('consultas'));
        }
    }
}
