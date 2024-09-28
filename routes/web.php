<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\http\Controllers\R_ObstetricoController;

Route::get('/', function () {
    return redirect('/login'); 
});


// ---------rutas para funcionalidad de usuario ------------------------
Auth::routes();
Route::get('/Usuarios', [UserController::class, 'listarUsuarios'])->name('listaUsuarios');
Route::get('/users/edit/{id}', [UserController::class, 'editar'])->name('users.edit');
Route::put('/users/update/{id}', [UserController::class, 'actualizar'])->name('users.update'); 
Route::delete('/users/delete/{id}', [UserController::class, 'eliminar'])->name('users.destroy');   

// controla las rutas para cada step de mi registro de nuevo paciente ------------------------------------

Route::get('/nuevo/paciente', [R_ObstetricoController::class, 'step1'])->name('registro.paso1');
Route::post('/nuevo/paciente', [R_ObstetricoController::class, 'storeStep1'])->name('registro.storeStep1');

// controla las rutas para el registro del encargado o esposo step2 -----------------------------------

Route::get('/nuevo/datos_esposo', [R_ObstetricoController::class, 'step2'])->name('registro.paso2');
Route::post('/nuevo/datos_esposo', [R_ObstetricoController::class, 'storeStep2'])->name('registro.storeStep2');


// listar los pacientes ---------------------------
Route::get('/paciente/lista', [R_ObstetricoController::class, 'listarpacientes'])->name('pacientes.listar');


route::get('/paciente/antecedente', function(){

    return view('layouts.antecedentes_obstetricos');
});

route::get('/paciente/historia', function(){

    return view('layouts.historia_clinica');
});

route::get('/embarazo/actual',function(){
    return view('layouts.embarazo');
});
route::get('/embarazo/peligro',function(){
    return view('layouts.signos_sintomas_peligro');
});


// listado de pacientes dashbord
route::get('/pacientes/listado',function(){
    return view('layouts.listado_pacientes');
});

// Para generar una nueva consulta y seguimiento prenatal
route::get('/pacientes/Consulta',function(){
    return view('layouts.consultas_prenatalesa');
});


route::get('/pacientes/examen',function(){
    return view('layouts.examen_fisico');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
