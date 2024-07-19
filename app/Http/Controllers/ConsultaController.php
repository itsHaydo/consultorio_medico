<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Expediente;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Medicamento;
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

    public function consulta()
    {
        if (auth()->user()->tipo === 'doctor') {
            $consultas = Cita::where('doctor_id', auth()->user()->id)->get();
            return view('doctor.consulta', compact('consultas'));
        }
    }

    public function tratamiento($id)
    {
        if (auth()->user()->tipo === 'doctor') {
            $item = Cita::findOrFail($id);
            $medicamentos = Medicamento::all();
            return view('doctor.servicios', compact('item', 'medicamentos'));
        }
    }

    public function guardar_consulta(Request $request, $id)
    {

        $consulta = Consulta::create([
            'cita_id' => $id,
            'paciente_id' => $request->paciente_id,
            'doctor_id' => auth()->user()->id,
            'fecha' => $request->fecha,
            'talla' => $request->talla,
            'peso' => $request->peso,
            'temperatura' => $request->temperatura,
            'presion' => $request->presion,
            'notas' => $request->notas,
        ]);

        if(!Expediente::where('paciente_id', $request->paciente_id)->exists()){
            Expediente::create([
                'consulta_id' => $consulta->id,
                'paciente_id' => $request->paciente_id,
                'fecha' => $consulta->created_at,
                'seguimiento' => "Consulta realizada",
            ]);
        }

        return redirect()->route('doctor.realizarcita', $id)->with('success', 'Consulta realizada exitosamente.');
    }

    public function editar_consulta(Request $request, $id)
    {

        $consulta = Consulta::findOrFail($id);
        $cita = Cita::findOrFail($consulta->cita_id);

        $consulta->update([
            'fecha' => $request->fecha,
        ]);

        $cita->update([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);

        return redirect()->route('consulta')->with('success', 'Consulta actualizada exitosamente.');
    }

}
