<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\User;
use App\Notifications\SendPasswordNotification;
use Illuminate\Support\Str;


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
        'email' => 'required|email|unique:pacientes|max:255',
        'telefono' => 'nullable|string|max:255',
        'fecha_nacimiento' => 'nullable|date',
        'genero_biologico' => 'required|in:Masculino,Femenino',
    ]);

    // Crear el paciente
    $paciente = Paciente::create($validatedData);

    // Verifica que el paciente se haya creado y tenga un ID
    if (!$paciente || !$paciente->id) {
        return back()->withErrors(['error' => 'No se pudo crear el paciente.']);
    }

    // Generar una contraseña aleatoria
    $password = Str::random(8);

    // Crear el usuario asociado al paciente
    $user = User::create([
        'name' => $validatedData['nombre'] . ' ' . $validatedData['apellido_p'] . ' ' . $validatedData['apellido_m'],
        'email' => $validatedData['email'],
        'password' => bcrypt($password),
        'tipo' => 'paciente',
        'especialidad' => null, // Asigna null o deja este campo vacío si no aplica para pacientes
    ]);

    

    // Después de crear el usuario, actualiza el campo paciente_id
    $user->paciente_id = $paciente->id;
    $user->save();
    // Enviar la notificación con la contraseña al correo del paciente
    $user->notify(new SendPasswordNotification($password));

    return redirect()->route('paciente');
}


    

    #muestra el form para editar a los pacientes solo si esta logueado como secretaria
    public function edit($id) {
        if (auth()->user()->tipo === 'secretaria' || auth()->user()->tipo === 'doctor' || auth()->user()->tipo === 'admin') {
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
        if (auth()->user()->tipo === 'secretaria' || auth()->user()->tipo === 'doctor' || auth()->user()->tipo === 'admin') {
            $pacientes = Paciente::all();
            return view('paciente.dashboard', ['pacientes' => $pacientes]);
        }
    }

    #mostrar el form de registrar nuevos pacientes
    public function registrar_paciente(){
        if (auth()->user()->tipo === 'secretaria' || auth()->user()->tipo === 'doctor' || auth()->user()->tipo === 'admin') {
            return view('paciente.registrar');
        }
    }

}
