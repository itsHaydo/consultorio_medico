<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsultaTratamiento;

class ConsultaTratamientoController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'consulta_id' => 'required|exists:consultas,id',
            'tratamiento_id' => 'required|exists:tratamientos,id',
        ]);

        dd($validated);
        // Crear un nuevo registro en la tabla consulta_tratamiento
        ConsultaTratamiento::create($validated);

        return redirect()->back()->with('success', 'Tratamiento agregado exitosamente.');
    }
}
