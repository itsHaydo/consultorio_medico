<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    #registra nuevo paciente
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


    #muestra el form para editar a los pacientes solo si esta logueado como secretaria
    public function edit($id) {
        if (auth()->user()->tipo === 'secretaria') {
            $paciente = Paciente::findOrFail($id);
            return view('paciente.edit', compact('paciente'));        
        }
    }
    
    #Actualiza en la base de datos lo que se cambie en la vista de editar pacietes
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_p' => 'required|string|max:255',
            'apellido_m' => 'required|string|max:255',
            'age' => 'required|integer',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:15',
            'fecha_nacimiento' => 'required|date',
            'genero_biologico' => 'required|string|max:255',
        ]);

        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->all());

        return redirect()->route('paciente')->with('success', 'Paciente actualizado correctamente');
    }

    #mostrar la lista de los pacientes solo si esta logueado como tipo secretaria
    public function paciente(){
        if (auth()->user()->tipo === 'secretaria' || auth()->user()->tipo === 'doctor') {
            $pacientes = Paciente::all();
            return view('paciente.dashboard', ['pacientes' => $pacientes]);
        }
    }

    #mostrar el form de registrar nuevos pacientes
    public function registrar_paciente(){
        if (auth()->user()->tipo === 'secretaria' || auth()->user()->tipo === 'doctor') {
            return view('paciente.registrar');
        }
    }

}
