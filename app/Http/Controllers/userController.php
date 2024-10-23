<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;


class UserController extends Controller
{
   

    public function listarUsuarios(Request $request)
    {

        $search = $request->input('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        })->paginate(10);


        return view('layouts.listar_Usuarios', compact('users'));
    }

    public function editar($id)
    {
        $user = User::findOrFail($id);
        return view('layouts.usuarios', compact('user'));
    }
    public function actualizar(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email']));

        return redirect()->route('listaUsuarios')->with('exelente', 'Usuario actualizado correctamente');
    }
    public function eliminar($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('listaUsuarios')->with('excelente', 'Usuario eliminado correctamente');
    }
    public function edit()
    {
        $user = Auth::user();

        return view('layouts.cambiarpass', compact('user'));
    }

    public function actualizarPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->password = Hash::make($request->new_password);
        
        $user->save();

        return redirect()->route('perfil')->with('success', 'La contraseña ha sido actualizada con éxito.');
    }

    public function editarperfil()
    {
        $user = Auth::user();

        
        return view('layouts.perfilusuario', compact('user'));
    }
    public function actualizarperfil(Request $request)
    {
        $user = Auth::user();
       
        $user->update($request->only(['name', 'email']));
        return redirect()->route('listaUsuarios')->with('exelente', 'Usuario actualizado correctamente');
    }

    

    public function perfil()
    {

        $user = Auth::user();


        return view('layouts.perfil', compact('user'));
    }
}
