<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function registro_paciente(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_p' => 'required|string|max:255',
            'apellido_m' => 'required|string|max:255',
            'age' => 'required|integer',
            'correo' => 'required|email|unique:pacientes|max:255',
            'telefono' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'genero_biologico' => 'required|in:Masculino,Femenino',
        ]);
    
        Paciente::create($validatedData);
        return redirect()->route('paciente');
    }
    
    public function paciente(){
        if (auth()->user()->tipo === 'secretaria') {
            $pacientes = Paciente::all();
            return view('secretaria.paciente', ['pacientes' => $pacientes]);
        }
    }

    public function registrar_paciente(){
        if (auth()->user()->tipo === 'secretaria') {
            return view('secretaria.registrar_paciente');
        }
    }


}
