<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\http\Controllers\R_ObstetricoController;
use App\Http\Controllers\AntecedentesObstetricosController;  // Correcto
use App\Http\Controllers\AsignarMedicamentoController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ConsultaPrenatal;
use App\Http\Controllers\Controllerconsejeria;
use App\Http\Controllers\Controllermedicamentos;
use App\Http\Controllers\ControllerSignos_peligro;
use App\Http\Controllers\embarazo;
use App\Http\Controllers\EmbarazoController;
use App\Http\Controllers\examen1Controller;
use App\Http\Controllers\GraficaController;
use App\Http\Controllers\historialClinico;
use App\Http\Controllers\PDFController;
use Barryvdh\DomPDF\Facade\Pdf; 
use App\Http\Controllers\ReporteController;

Route::get('/', function () {
    return redirect('/login'); 
});

// ---------Rutas para el login y usurio ------------------------
Auth::routes();
// ---------rutas para funcionalidad de usuario ------------------------
Route::get('/Usuarios', [UserController::class, 'listarUsuarios'])->name('listaUsuarios');
Route::get('/users/edit/{id}', [UserController::class, 'editar'])->name('users.edit');
Route::put('/users/update/{id}', [UserController::class, 'actualizar'])->name('users.update'); 
Route::delete('/users/delete/{id}', [UserController::class, 'eliminar'])->name('users.destroy');
Route::get('/users/editar/{id}', [UserController::class, 'edit'])->name('users.password');

Route::put('/users/update-password/{id}', [UserController::class, 'actualizarPassword'])->name('users.updatePassword');

Route::get('/ruta/cambio', function () {
    return view('layouts.cambiarpass'); 
});

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
//Route::get('/embarazo/actual', [EmbarazoController::class, 'obtener'])->name('pacientes.Obtener');
//Route::post('/embarazo/actual', [EmbarazoController::class, 'guardar'])->name('pacientes.guardar');


//------------------------------- seguimiento nutricional-----------
Route::get('/embarazo/nutricion', [EmbarazoController::class, 'obtener'])->name('nutricion.Obtener');
Route::post('/embarazo/nutricion', [EmbarazoController::class, 'guardar'])->name('nutricion.guardar');
//------------------------------- seguimiento prenatal ----------
Route::get('/embarazo/consulta1', [ConsultaPrenatal::class, 'obtener'])->name('consulta.Obtener');
Route::post('/embarazo/consulta1', [ConsultaPrenatal::class, 'guardar'])->name('consulta.guardar');
//------------------------------- Examen fisico ----------
Route::get('/embarazo/examen1/{consultaId}', [examen1Controller::class, 'obtener'])->name('examen.Obtener');
Route::post('/embarazo/examen1/{consultaId}', [examen1Controller::class, 'guardar'])->name('examen.guardar');
//------------------------------- Signos y sintomas de peligro ----------
Route::get('/embarazo/signos/{examenFisicoId}', [ControllerSignos_peligro::class, 'obtener'])->name('signos.obtener');
Route::post('/embarazo/signos/{examenFisicoId}', [ControllerSignos_peligro::class, 'guardar'])->name('signos.guardar');
//------------------------------- Rutas de consejeria  ----------
Route::get('/embarazo/consejeria/{examenFisicoId}', [Controllerconsejeria::class, 'obtener'])->name('consejeria.Obtener');
Route::post('/embarazo/consejeria/{examenFisicoId}', [Controllerconsejeria::class, 'guardar'])->name('consejeria.guardar');
//------------------------------- Asignacion de suplementos  ----------
Route::get('/medicamentos/asignar/{examenFisicoId}', [AsignarMedicamentoController::class, 'obtener'])->name('medicamentos.asignar');
Route::post('/medicamentos/asignar/{examenFisicoId}', [AsignarMedicamentoController::class, 'guardar'])->name('medicamentos.asignar.guardar');
//------------------------------ rutas para el calendario de citas ---------
Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario.index');
Route::get('/calendario/citas', [CalendarioController::class, 'getCitas'])->name('calendario.citas');



//------------------------------- Rutas de Suplementos disponibles ----------
Route::get('/medicamentos', [Controllermedicamentos::class, 'index'])->name('medicamentos.index');
Route::post('/medicamentos', [Controllermedicamentos::class, 'store'])->name('medicamentos.store');
Route::get('/medicamentos/{id}/edit', [Controllermedicamentos::class, 'edit'])->name('medicamentos.edit');
Route::put('/medicamentos/{id}', [Controllermedicamentos::class, 'update'])->name('medicamentos.update');
Route::delete('/medicamentos/{id}', [Controllermedicamentos::class, 'destroy'])->name('medicamentos.destroy');


// en proceso de desarrollo para generar los pdfs 

Route::get('/reporte-paciente', [PDFController::class, 'generarPDF']);




//-------------- falta por terminar -----------------------
// listado de pacientes dashbord




// en proceso de creacion de graficos para el dashbord principal 
Route::get('/grafica/cobertura', [GraficaController::class, 'mostrarCobertura'])->name('grafica.cobertura');





// Ruta para obtener los eventos
Route::get('/fullcalendar/events', function () {
    // Aquí puedes devolver eventos de una base de datos o cualquier otra fuente
    return response()->json([
        [
            'title' => 'Evento 1',
            'start' => '2024-10-05',
            'end' => '2024-10-06'
        ],
        [
            'title' => 'Evento 2',
            'start' => '2024-10-10',
            'end' => '2024-10-12'
        ]
    ]);
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
