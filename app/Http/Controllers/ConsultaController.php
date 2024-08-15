<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Expediente;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Medicamento;
use App\Models\Tratamiento;
use App\Notifications\ConsultaRealizadaNotification;
use Barryvdh\DomPDF\Facade\Pdf; // Add this at the top
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpedientePacienteMail;
use ExpedientePacienteMail as GlobalExpedientePacienteMail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ConsultaController extends Controller
{

    public function realizar($id)
    {
        $consulta = Cita::findOrFail($id);
        $item = Cita::findOrFail($id);
        $medicamentos = Medicamento::all();
        return view('doctor.realizarcita', compact('consulta','item','medicamentos'));
    }

    public function agendar_cita()
    {
        if (auth()->user()->tipo === 'doctor') {
            $pacientes = Paciente::all();
            $doctores = User::where('tipo', 'doctor')->get();
            return view('cita.agendar', compact('pacientes', 'doctores'));
        }
    }

    public function citas_paciente()
    {
        // Get the currently authenticated user
        $user = auth()->user();

        // Retrieve only pending consultations for the authenticated user
        $citas = Cita::where('paciente_id', $user->paciente_id)
                         ->where('realizado', 0) // Assuming 0 means not completed
                         ->orderBy('fecha', 'desc') // Order by date descending
                         ->get();

        return view('paciente.citas_paciente', ['citas' => $citas]);
    }


    public function consulta()
{
    if (auth()->user()->tipo === 'doctor') {
        $consultas = Cita::where('doctor_id', auth()->user()->id)
                         ->where('realizado', false)
                         ->get();
        return view('doctor.consulta', compact('consultas'));
    }
}


    public function tratamiento($id)
    {
        if (auth()->user()->tipo === 'doctor') {
            $consulta = Cita::findOrFail($id);
            $item = Cita::findOrFail($id);
            $medicamentos = Medicamento::all();
            return view('doctor.servicios', compact('consulta','item', 'medicamentos'));
        }
    }
    
    public function guardar_consulta(Request $request, $id){
        // Crear la consulta
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
    
        // Crear el expediente si no existe
        if (!Expediente::where('paciente_id', $request->paciente_id)->exists()) {
            Expediente::create([
                'consulta_id' => $consulta->id,
                'paciente_id' => $request->paciente_id,
                'fecha' => $consulta->created_at,
                'seguimiento' => "Consulta realizada",
            ]);
        }
    
        // Actualizar la columna 'realizado' en la tabla citas
        $cita = Cita::find($id);
        $cita->realizado = true;
        $cita->save();
    
        // Asegúrate de que el paciente tiene una dirección de correo válida
        $paciente = Paciente::find($consulta->paciente_id);
        if ($paciente && $paciente->email) {
            // Enviar notificación al paciente con los detalles de la consulta
            $paciente->notify(new ConsultaRealizadaNotification($consulta));
        } else {
            // Manejo en caso de que el paciente no tenga email
            return redirect()->route('consulta', $id)->with('error', 'No se pudo enviar la notificación, el paciente no tiene una dirección de correo.');
        }
    
        return redirect()->route('consulta', $id)->with('success', 'Consulta realizada exitosamente.');
    }
    



    public function editar_consulta(Request $request, $id){

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


    public function consultas_paciente()
{
    // Obtén el usuario autenticado
    $user = auth()->user();

    // Encuentra al paciente relacionado con este usuario
    $paciente = User::where('paciente_id', $user->paciente_id)->first();


    // Verifica si se encontró un paciente asociado
    if ($paciente) {
        $pacienteId = $paciente->paciente_id;

        // Obtén las consultas y expedientes del paciente usando el ID del paciente
        $consultas = Consulta::where('paciente_id', $pacienteId)->get();
        $expedientes = Expediente::where('paciente_id', $pacienteId)->get();
        return view('paciente.consultas_paciente', [
            'consultas' => $consultas,
            'expedientes' => $expedientes,
        ]);
    } else {
        // Maneja el caso donde no se encuentra un paciente relacionado
        return redirect()->back()->with('error', 'Paciente no encontrado');
    }
}


public function paciente_consultas_detalles($id)
{
    // Obtén la consulta específica
    $consulta = Consulta::find($id);

    if (!$consulta) {
        // Handle the case where the consultation is not found
        return redirect()->route('some_route_name')->with('error', 'Consulta no encontrada');
    }

    // Obtén los tratamientos asociados a esta consulta
    $tratamientos = Tratamiento::where('cita_id', $consulta->id)->get();

    // Pasar la consulta y los tratamientos a la vista
    return view('paciente.paciente_consultas_detalles', [
        'consulta' => $consulta,
        'tratamientos' => $tratamientos,
    ]);
}

public function generatePdf($id)
{
    $consulta = Consulta::find($id);

    if (!$consulta) {
        return redirect()->route('some_route_name')->with('error', 'Consulta no encontrada');
    }

    $tratamientos = Tratamiento::where('cita_id', $consulta->id)->get();

    $pdf = Pdf::loadView('paciente.paciente_consultas_pdf', [
        'consulta' => $consulta,
        'tratamientos' => $tratamientos,
    ]);

    return $pdf->download('consulta_' . $id . '.pdf');
}


public function sendMedicalRecord($pacienteId)
{
    $consultas = Consulta::where('paciente_id', $pacienteId)->get();

    if ($consultas->isEmpty()) {
        return redirect()->back()->with('error', 'No se encontraron consultas para este paciente.');
    }

    $pdfs = [];

    foreach ($consultas as $consulta) {
        $tratamientos = Tratamiento::where('cita_id', $consulta->id)->get();
        $pdf = Pdf::loadView('paciente.paciente_consultas_pdf', [
            'consulta' => $consulta,
            'tratamientos' => $tratamientos,
        ]);
        $pdfPath = storage_path("app/public/consulta_{$consulta->id}.pdf");
        $pdf->save($pdfPath);
        $pdfs[] = $pdfPath;
    }

    $paciente = Paciente::find($pacienteId);

    if (!$paciente) {
        return redirect()->back()->with('error', 'Paciente no encontrado.');
    }

    Mail::to($paciente->email)->send(new ExpedientePacienteMail($pdfs));

    // Optionally delete PDFs after sending
    foreach ($pdfs as $pdfPath) {
        unlink($pdfPath);
    }

    return redirect()->back()->with('success', 'Expediente médico enviado al correo del paciente.');
}


}
