<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use App\Models\Pago;

class PagoController extends Controller
{

    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        return view('pago.edit', compact('pago'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|string',
            'metodo_pago' => 'required|string',
        ]);

        $pago = Pago::findOrFail($id);
        $pago->estado = $request->estado;
        $pago->metodo_pago = $request->metodo_pago;
        $pago->fecha_pago = now();
        $pago->save();

        $cita = Cita::where('id', $pago->cita_id);
        $cita->update([
            'pagada' => 1
        ]);

        if(auth()->user()->tipo == 'doctor'){
            return redirect()->route('doctor.realizarcita', $pago->cita_id)->with('success', 'Pago actualizado correctamente');
        }else{
            return redirect()->route('pago')->with('success', 'Pago actualizado correctamente');
        }
    }

    public function pago(){
        if (auth()->user()->tipo === 'secretaria' || auth()->user()->tipo === 'doctor') {
            $pagos = Pago::where('estado', 'pendiente')->get();
            return view('pago.dashboard', ['pagos' => $pagos]);
        }
    }

    public function historial(){
        if (auth()->user()->tipo === 'secretaria') {
            $pagos = Pago::where('estado', 'pagado')->get();
            return view('pago.historial', ['pagos' => $pagos]);
        }
    }

}
