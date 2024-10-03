<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\http\Controllers\R_ObstetricoController;
use App\Http\Controllers\AntecedentesObstetricosController;  // Correcto
use App\Http\Controllers\embarazo;
use App\Http\Controllers\EmbarazoController;
use App\Http\Controllers\historialClinico;

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

// guarda los antecedentes del paciente ---------------------

Route::get('/paciente/antecedentes', [AntecedentesObstetricosController::class, 'step'])->name('antecedentes.show');
Route::post('/paciente/antecedentes', [AntecedentesObstetricosController::class, 'submit'])->name('antecedentes.submit');

// guarda el historial del embarazo de la paciente ----------

Route::get('/embarazo', [embarazo::class, 'mostrarFormulario'])->name('embarazo.mostrar');
Route::post('/embarazo', [embarazo::class, 'guardarFormulario'])->name('embarazo.guardar');

// guarda el historial de la paciente el historial clinico ----------

Route::get('/historial', [historialClinico::class, 'mostrarFormulario'])->name('historial.mostrar');
Route::post('/historial', [historialClinico::class, 'guardarHistorial'])->name('historial.guardar');


//-----------------------------------------------------------------------------------//
// listar los pacientes ---------------------------
Route::get('/paciente/lista', [R_ObstetricoController::class, 'listarpacientes'])->name('pacientes.listar');



//------------------------------- embarazo actual peso imc etc ---------------------
Route::get('/embarazo/actual', [EmbarazoController::class, 'obtener'])->name('pacientes.Obtener');
Route::post('/embarazo/actual', [EmbarazoController::class, 'guardar'])->name('pacientes.guardar');


//------------------------------- seguimiento prenatal 
//Route::get('/embarazo/nutricion', [EmbarazoController::class, 'obtener'])->name('nutricion.Obtener');
//Route::post('/embarazo/nutricion', [EmbarazoController::class, 'guardar'])->name('nutricion.guardar');


// falta por terminar ----------------------------
Route::get('/embarazo/peligro',function(){
    return view('layouts.signos_sintomas_peligro');
});


Route::get('/embarazo/nutricion',function(){
    return view('layouts.control');
});



// listado de pacientes dashbord
Route::get('/pacientes/listado',function(){
    return view('layouts.listado_pacientes');
});

// Para generar una nueva consulta y seguimiento prenatal
Route::get('/pacientes/Consulta',function(){
    return view('layouts.consultas_prenatalesa');
});


Route::get('/pacientes/examen',function(){
    return view('layouts.examen_fisico');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
