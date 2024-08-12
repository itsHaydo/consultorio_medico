<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\User;
use Spatie\FlareClient\View;

class MenuController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function welcome(){
        if (auth()->user()->tipo === 'secretaria' ) {
            return view('secretaria.dashboard');
        }else if(auth()->user()->tipo === 'doctor') {
            $consultas = Cita::where('doctor_id', auth()->user()->id)->get();
            $pacientes = Paciente::all();
            $doctores = User::where('id', auth()->user()->id)->get();

            return view('doctor.dashboard', compact('consultas', 'pacientes', 'doctores'));
        }else if (auth()->user()->tipo === 'paciente'){
            return view('paciente.dashboard2');
        }else{
            return view('admin.dashboard');
        }
    }

    public function consultas(){
        return view('doctor.consulta');
    }

    public function expedientes(){
        return view('doctor.expediente');
    }

    public function medicamentos(){
        return view('producto.dashboard');
    }
    
    public function index()
    {
        if (auth()->user()->tipo === 'secretaria') {
            return view('secretaria.dashboard');
        } elseif (auth()->user()->tipo === 'doctor') {
            $consultas = Cita::where('doctor_id', auth()->user()->id)->get();
            $pacientes = Paciente::all();
            $doctores = User::where('id', auth()->user()->id)->get();

            return view('doctor.dashboard', compact('consultas', 'pacientes', 'doctores'));
        }elseif (auth()->user()->tipo === 'admin'){
            return view('admin.dashboard');
        } else{
            return view('dashboard');
        }
    }

}
