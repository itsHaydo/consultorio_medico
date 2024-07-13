<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function administrar_usuarios()
    {
        if (auth()->user()->tipo === 'admin') {
            // Filtra usuarios que no tienen el rol de 'medico' o 'secretario'
            $users = User::whereNull('tipo')->get();
            return view('admin.administrar_usuarios', compact('users'));
        }
    }

    public function administrar_doctores()
    {
        if (auth()->user()->tipo === 'admin') {
            // Filtra usuarios que no tienen el rol de 'medico' o 'secretario'
            $users = User::whereNotIn('tipo', ['secretario','admin'])->get();
            return view('admin.administrar_usuarios', compact('users'));
        }
    }

    public function updateUserRole(Request $request, $id)
    {
        if (auth()->user()->tipo === 'admin') {
            $user = User::findOrFail($id);
            $user->tipo = $request->input('tipo');
            $user->save();

            return redirect()->back()->with('success', 'Rol asignado correctamente');
        }

    }

    public function editar_usuarios()
    {
        if (auth()->user()->tipo === 'admin') {
            // Filtra usuarios que no tienen el rol de 'medico' o 'secretario'
            $users = User::whereNotIn('tipo', ['secretario','admin'])->get();
            return view('admin.editar', compact('users'));
        }
    }
}
