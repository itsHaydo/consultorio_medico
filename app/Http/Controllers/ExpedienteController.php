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

    public function crear_pdf($id)
    {
        $pdf = app('dompdf.wrapper');
        $consulta = Consulta::where('paciente_id', $id)->get();
        $estilos = '<style> body {font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;} .container { width: 80%; margin: 20px auto; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 8px; } h1 { text-align: center; color: #333; } .patient-info { margin-bottom: 20px; } .patient-info h2 { color: #666; } .patient-info p { margin: 5px 0; } .appointments { margin-top: 20px; } .appointment { border-bottom: 1px solid #ddd; padding: 10px 0; } .appointment:last-child { border-bottom: none; } .appointment h3 { color: #007BFF; margin: 0; } .appointment p { margin: 5px 0; color: #555; } </style> <br>';
        $cuerpo = $estilos.'<div class="container"><h1>Expediente Médico</h1>';
        $nombrePac = "";
        
        for ($i=0; $i < count(json_decode($consulta, true)); $i++) {
            $tratamiento = Tratamiento::where('cita_id', $consulta[$i]->cita_id)->get();
            $cita = Cita::where('id', $consulta[$i]->cita_id)->get();   

            foreach($cita as $itemCita){
                $nombrePac = $itemCita->paciente->nombre. ' ' .$itemCita->paciente->apellido_p. ' ' .$itemCita->paciente->apeliido_m;
                $cuerpo = $cuerpo.'<div class="patient-info">';
                    $cuerpo = $cuerpo.'<h2>Información del Paciente</h2>';
                    $cuerpo = $cuerpo.'<p><strong>Nombre:</strong> '. $itemCita->paciente->nombre. ' ' .$itemCita->paciente->apellido_p. ' ' .$itemCita->paciente->apeliido_m  .'</p>';
                    $cuerpo = $cuerpo.'<p><strong>Edad:</strong> '. $itemCita->paciente->age .' años</p>';
                    $cuerpo = $cuerpo.'<p><strong>Género:</strong> '. $itemCita->paciente->genero_biologico .'</p>';
                $cuerpo = $cuerpo.'</div>';

                $cuerpo = $cuerpo.'<div class="appointments">';
                    $cuerpo = $cuerpo.'<h2>Cita Médicas</h2>';
                    $cuerpo = $cuerpo.'<div class="appointment">';
                        
                        $cuerpo = $cuerpo.'<div class="appointments">';
                            $cuerpo = $cuerpo.'<h2>Consulta General</h2>';
                            $cuerpo = $cuerpo.'<div class="appointment">';
                                $cuerpo = $cuerpo.'<p><strong>Fecha:</strong> '. $itemCita->fecha .'</p>';
                                $cuerpo = $cuerpo.'<p><strong>Hora:</strong> '. $itemCita->hora .'</p>';
                                $cuerpo = $cuerpo.' <p><strong>Médico:</strong> '. $itemCita->doctor->name .'</p>';  
                            $cuerpo = $cuerpo.'</div>';
                        $cuerpo = $cuerpo.'</div>';

                        $cuerpo = $cuerpo.'<div class="appointments">';
                            $cuerpo = $cuerpo.'<h2>Detalles de Consulta</h2>';
                            $cuerpo = $cuerpo.'<div class="appointment">';
                                $cuerpo = $cuerpo.'<p><strong>Talla:</strong> '. $consulta[$i]->talla .'</p>';
                                $cuerpo = $cuerpo.'<p><strong>Peso:</strong> '. $consulta[$i]->peso .'</p>';
                                $cuerpo = $cuerpo.'<p><strong>Temperatura:</strong> '. $consulta[$i]->temperatura .'</p>';
                                $cuerpo = $cuerpo.'<p><strong>Presion:</strong> '. $consulta[$i]->presion .'</p>';
                                $cuerpo = $cuerpo.'<br><p><strong>Notas Médicas:</strong> '. $consulta[$i]->notas .'</p>';
                            $cuerpo = $cuerpo.'</div>';
                        $cuerpo = $cuerpo.'</div>';

                        $cuerpo = $cuerpo.'<div class="appointments">';
                        $cuerpo = $cuerpo.'<h2>Tratamientos medicos</h2>';

                        foreach($tratamiento as $itemTratamiento){
                            $cuerpo = $cuerpo.'<div class="appointment">';
                                $cuerpo = $cuerpo.'<p><strong>Fechas de consumo:</strong> '. $itemTratamiento->fecha_inicio. ' a ' . $itemTratamiento->fecha_fin .'</p>';
                                $cuerpo = $cuerpo.'<p><strong>Instrucciones de consumo:</strong> '. $itemTratamiento->descripcion .'</p>';
                                $cuerpo = $cuerpo.'<p><strong>Nombre del medicamento:</strong> '. $itemTratamiento->medicamento->nombre .'</p>';
                            $cuerpo = $cuerpo.'</div>';
                        }
                        $cuerpo = $cuerpo.'</div>';

                    $cuerpo = $cuerpo.'</div>';
                $cuerpo = $cuerpo.'</div>';

            }


        }

        $cuerpo = $cuerpo."</>";
        $pdf->loadHTML($cuerpo);
        return $pdf->download('Expediente de '. $nombrePac .'.pdf');
    }

    public function ver_tratamiento($id)
    {
        $consulta = Consulta::where('paciente_id', $id)->get();
        $idpac = $id;
        return view('doctor.tratamiento', compact('consulta','idpac'));
    }

    public function ver_clientes()
    {
        $expediente = Expediente::all();
        return view('doctor.expediente', compact('expediente'));
    }
}
