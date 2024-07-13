<?php

namespace App\Http\Controllers;

use Spatie\FlareClient\View;

class MenuController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function welcome(){
        if (auth()->user()->tipo === 'secretaria' || auth()->user()->tipo === 'doctor') {
            return view('welcome');
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
    
    public function index()
    {
        if (auth()->user()->tipo === 'secretaria') {
            return view('secretaria.dashboard');
        } elseif (auth()->user()->tipo === 'doctor') {
            return view('doctor.dashboard');
        }elseif (auth()->user()->tipo === 'admin'){
            return view('admin.dashboard');
        } else{
            return view('dashboard');
        }
    }

}
