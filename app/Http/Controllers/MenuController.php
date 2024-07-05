<?php

namespace App\Http\Controllers;

use Spatie\FlareClient\View;

class MenuController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function welcome(){
        return view('welcome');
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
            return view('doctor.dashboard');
        } else{
            return view('dashboard');
        }
    }

}
