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
use App\Http\Controllers\CoberturaPrenatalController;
use App\Http\Controllers\ReporteController;
use App\Notifications\CitasNotification;


use App\Models\User;
use Illuminate\Routing\RouteGroup;

Route::get('/', function () {
    return redirect('/login');
});

// ---------Rutas para el login y usurio ------------------------
Auth::routes();
Route::middleware('auth')->get('/perfil', [UserController::class, 'perfil'])->name('perfil');
Route::middleware('auth')->post('/perfil/actualizar', [UserController::class, 'actualizar'])->name('perfil.actualizar');

Route::middleware(['auth'])->group(function () {

    // ---------rutas para funcionalidad  privadas  ------------------------
    Route::get('/Usuarios', [UserController::class, 'listarUsuarios'])->name('listaUsuarios');
    Route::get('/users/edit/{id}', [UserController::class, 'editar'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'actualizar'])->name('users.update');
    Route::delete('/users/delete/{id}', [UserController::class, 'eliminar'])->name('users.destroy');
    Route::get('/users/editar/{id}', [UserController::class, 'edit'])->name('users.password');

    Route::put('/users/update-password/{id}', [UserController::class, 'actualizarPassword'])->name('users.updatePassword');
    // Asignar rol de usuario
    Route::put('/users/{id}/asignar-rol', [UserController::class, 'asignarRol'])->name('asignar.rol');

//---------------------------------------visualizacion general del paciente ----------------------------------------------------------------//

    // ------------------------------listar los pacientes ---------------------------
    Route::get('/paciente/lista', [R_ObstetricoController::class, 'listarpacientes'])->name('pacientes.listar');
//--------------------------------------------------------------------------------------------------------------------------------------------//


//-----------------------------------------------------------Rutas especificas de registro de paciente --------------------------------------//


    // controla las rutas para cada step de mi registro de nuevo paciente anexo>ficha 1 ------------------------------------
    Route::get('/nuevo/paciente', [R_ObstetricoController::class, 'step1'])->name('registro.paso1');
    Route::post('/nuevo/paciente', [R_ObstetricoController::class, 'storeStep1'])->name('registro.storeStep1');

    // controla las rutas para el registro del encargado o esposo step2  anexo> ficha 1-----------------------------------
    Route::get('/nuevo/datos_esposo', [R_ObstetricoController::class, 'step2'])->name('registro.paso2');
    Route::post('/nuevo/datos_esposo', [R_ObstetricoController::class, 'storeStep2'])->name('registro.storeStep2');

    // guarda los antecedentes del paciente anexo>ficha1 ---------------------
    Route::get('/paciente/antecedentes', [AntecedentesObstetricosController::class, 'step'])->name('antecedentes.show');
    Route::post('/paciente/antecedentes', [AntecedentesObstetricosController::class, 'submit'])->name('antecedentes.submit');

    // guarda el historial del embarazo de la paciente  anexo>ficha1----------
    Route::get('/embarazo', [embarazo::class, 'mostrarFormulario'])->name('embarazo.mostrar');
    Route::post('/embarazo', [embarazo::class, 'guardarFormulario'])->name('embarazo.guardar');

    // guarda el historial de la paciente el historial clinico anexo>ficha1 ---------
    Route::get('/historial', [historialClinico::class, 'mostrarFormulario'])->name('historial.mostrar');
    Route::post('/historial', [historialClinico::class, 'guardarHistorial'])->name('historial.guardar');
//----------------------------------------------------------------------------------------------------------------------------------------------------//



// ------------------------------------------Ficha de atencion a la embarazada -----------------------------------------------------------------//

    //------------------------------- seguimiento nutricional-----------
    Route::get('/embarazo/nutricion', [EmbarazoController::class, 'obtener'])->name('nutricion.Obtener');
    Route::post('/embarazo/nutricion', [EmbarazoController::class, 'guardar'])->name('nutricion.guardar');
//-------------------------------------------------------------------------------------------------------------------------------------------//


// --------------------------------------- Ficha prenatal yo post parto ---------------------------------------------------------------------//

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
//-------------------------------------------------------------------------------------------------------------------------------------------//

    //------------------------------ rutas para el calendario de citas ---------
    Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario.index')->middleware('auth');
    Route::get('/calendario/citas', [CalendarioController::class, 'getCitas'])->name('calendario.citas');



    //------------------------------- Rutas de Suplementos disponibles ----------
    Route::get('/medicamentos', [Controllermedicamentos::class, 'index'])->name('medicamentos.index');
    Route::post('/medicamentos', [Controllermedicamentos::class, 'store'])->name('medicamentos.store');
    Route::get('/medicamentos/{id}/edit', [Controllermedicamentos::class, 'edit'])->name('medicamentos.edit');
    Route::put('/medicamentos/{id}', [Controllermedicamentos::class, 'update'])->name('medicamentos.update');
    Route::delete('/medicamentos/{id}', [Controllermedicamentos::class, 'destroy'])->name('medicamentos.destroy');



    // en proceso de creacion de graficos para el dashbord principal --------
    Route::get('/grafica/cobertura', [GraficaController::class, 'mostrarCobertura'])->name('grafica.cobertura');


    // grafico de cobertura en proceso
    Route::get('/grafica1', [CoberturaPrenatalController::class, 'verGrafica'])->name('grafica1');
    Route::get('/ingresar-mes/{anio}', [CoberturaPrenatalController::class, 'mostrarFormularioMes'])->name('ingresarMes');
    Route::post('/guardar-mes', [CoberturaPrenatalController::class, 'guardarMes'])->name('guardarMes');
    Route::get('/ingresar-anio', [CoberturaPrenatalController::class, 'mostrarFormularioAnio'])->name('ingresarAnio');
    Route::post('/guardar-anio', [CoberturaPrenatalController::class, 'guardarAnio'])->name('guardarAnio');




    // en proceso de desarrollo para generar los pdfs 

    //Route::post('/reporte-paciente', [PDFController::class, 'generarPDF'])->name('reporte-paciente');




    //-------------- falta por terminar -----------------------
    // listado de pacientes dashbord







    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



    //graficas del home por si las termino xd
    Route::get('/grafica2', [GraficaController::class, 'mostrarGrafica2'])->name('grafica2');
    Route::get('/grafica3', [GraficaController::class, 'mostrarGrafica3'])->name('grafica3');
    Route::get('/grafica4', [GraficaController::class, 'mostrarGrafica4'])->name('grafica4');
});
// sigo en la pruebas en caliente 
Route::get('/seleccionar-reporte/{paciente}', [ReporteController::class, 'mostrarVista'])->name('mostrarVistaReporte');
Route::post('/descargar-reporte', [ReporteController::class, 'descargarReporte'])->name('reporte-paciente');

//------------------------------- listo cada uno de mis reportes ------------------------------------------------------//
Route::get('/reporte/obstetrico/{pacienteCui}', [ReporteController::class, 'reporteObstetrico'])->name('reporte.obstetrico');
Route::get('/reporte/prenatal/{pacienteCui}', [ReporteController::class, 'reportePrenatal'])->name('reporte.prenatal');
Route::get('/reporte/seguimiento/{pacienteCui}', [ReporteController::class, 'reporteSeguimiento'])->name('reporte.seguimiento');
Route::get('/reporte/examen/{pacienteCui}', [ReporteController::class, 'reporteExamen'])->name('reporte.examen');

