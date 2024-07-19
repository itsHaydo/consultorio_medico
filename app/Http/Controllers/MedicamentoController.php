<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\Tratamiento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    public function ver_productos(){
        $productos = Medicamento::all();
        return view('producto.dashboard', compact('productos'));
    }

    public function registrar_producto(){
        return view('producto.registrar');
    }

    public function editar_producto($id){
        $producto = Medicamento::where('id', $id)->firstOrFail();

        return view('producto.edit', compact('producto'));
    }

    public function modificar_producto(Request $request, $id){
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'fecha_caducidad' => 'required|date|after:today',
            'cantidad' => 'required|integer|min:1',
            'unidad_medida' => 'required|string|max:255',
        ]);

        $medicamento = Medicamento::FindOrFail($id);
        $medicamento->update($request->all());

        return redirect()->route('medicamentos')->with('success', 'Producto editado exitosamente.');
    }

    public function agregar_producto(Request $request){
        Medicamento::create(
            [
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'fecha_caducidad' => $request->fecha_caducidad,
                'cantidad' => $request->cantidad,
                'medida' => $request->unidad_medida,
                'estado' => 'disponible',
            ]
        );

        return redirect()->route('medicamentos')->with('success', 'Producto agregado exitosamente.');
    }

    public function destroy_tratamiento($id){

        $tratamiento = Tratamiento::where('medicamento_id', $id)->get();

        foreach($tratamiento as $item){
            $item->delete();
        }

        Medicamento::where('id', $id)->delete();
        return redirect()->route('medicamentos')->with('success', 'Medicamento eliminado');
    }

}
