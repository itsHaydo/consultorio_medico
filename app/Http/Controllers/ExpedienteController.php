<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente;
use App\Models\Tratamiento;

class ExpedienteController extends Controller
{

    public function crear_tratamiento(Request $request, $id)
    {

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

    public function destroy_tratamiento($id){
        $dato = Tratamiento::where('id', $id)->firstOrFail();

        $idpac = $dato->paciente_id;
        $dato->delete();
        return redirect()->route('doctor.expediente', $idpac)->with('success', 'Tratamiento eliminado');
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
