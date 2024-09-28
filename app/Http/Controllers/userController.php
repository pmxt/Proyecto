<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function listarUsuarios( Request $request){
       
      $search = $request->input('search'); // Recibe el valor de búsqueda
        $users = User::when($search, function($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                         ->orWhere('email', 'LIKE', "%{$search}%");
        })->paginate(10); 

      // return los usuarios a la vista listar U
        return view('layouts.listar_Usuarios', compact('users'));
      
      
     
    }  
    // recibimos los parametros del usuario dentro de la funcion.
    public function editar($id){
     $user = User::findOrFail($id);
     return view('layouts.usuarios', compact('user'));

    }
     public function actualizar(Request $request,$id){
      $user = User::findOrFail($id);
      $user->update($request->only(['name', 'email'])); // Actualiza los campos necesarios

      return redirect()->route('listaUsuarios')->with('exelente', 'Usuario actualizado correctamente');


     }
     public function eliminar($id){
      $user = User::findOrFail($id);
      $user -> delete();
      return redirect()->route('listaUsuarios')->with('excelente', 'Usuario eliminado correctamente');


     }

    }

    

