<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;
use App\Models\Expediente;
use App\Models\Medicamento;
use App\Models\Tratamiento;
use App\Models\Pago;
use App\Models\Cita;

class ExpedienteController extends Controller
{

    public function crear_tratamiento(Request $request, $id)
    {

        Tratamiento::create(
            [
                'medicamento_id' => $request->producto_id,
                'cita_id' => $request->cita_id,
                'doctor_id' => $request->doctor_id,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'descripcion' => $request->descripcion,
            ]
        );

        $producto = Medicamento::where('id', $request->producto_id)->firstOrFail();
        $citapago = Pago::where('cita_id', $request->cita_id)->firstOrFail();

        $citapago->update(
            [
                'monto' => $citapago->monto + ($producto->precio * $request->cantidad),
            ]
        );

        $producto->update(
            [
                'cantidad' => $producto->cantidad - $request->cantidad,
            ]
        );

        return redirect()->route('doctor.servicios', $id)->with('success', 'Servicio agregado exitosamente.');
    }

    public function destroy_tratamiento($id)
    {
        $dato = Tratamiento::where('id', $id)->firstOrFail();

        $idpac = $dato->paciente_id;
        $dato->delete();
        return redirect()->route('doctor.expediente', $idpac)->with('success', 'Tratamiento eliminado');
    }

    public function ver_tratamiento($id)
    {
        $consulta = Consulta::where('paciente_id', $id)->firstOrFail();
        $tratamiento = Tratamiento::where('cita_id', $consulta->cita_id)->get();
        $cita = Cita::where('id', $consulta->cita_id)->firstOrFail();
        return view('doctor.tratamiento', compact('tratamiento', 'consulta', 'cita'));
    }

    public function ver_clientes()
    {
        $expediente = Expediente::all();
        return view('doctor.expediente', compact('expediente'));
    }
}
