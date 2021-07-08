<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\GradoSeccionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\SeccionController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
//Reportes
Route::get('/rpt-grado', function () {
    return view('rpt.grado');
});
Route::get('/rpt-seccion', function () {
    return view('rpt.seccion');
});
Route::get('/rpt-nivel', function () {
    return view('rpt.nivel');
});
//Obtener la data del rpt de grados
Route::post('/rpt-res-grado', [DiagnosticoController::class, 'rptresgrados']);
//Obtener la data del rpt de secciones
Route::post('/rpt-res-seccion', [DiagnosticoController::class, 'rptressecciones']);
//Obtener la data del rpt de niveles
Route::post('/rpt-res-nivel', [DiagnosticoController::class, 'rptresniveles']);
// Route::get('/colaborador/create', [ColaboradorController::class, 'create']);


// Crea rutas acorde a los metodos del controlador
Route::resource('colaborador', ColaboradorController::class)->middleware("auth");
Route::resource('estudiante', EstudianteController::class)->middleware("auth");
Route::resource('diagnostico', DiagnosticoController::class)->middleware("auth");
//override del diagnostico create que viene por defecto
Route::get('diagnostico/{id}/create','App\Http\Controllers\DiagnosticoController@create')->middleware("auth");
Route::resource('pregunta', PreguntaController::class)->middleware("auth");
Route::resource('usuario', UsuarioController::class)->middleware("auth");
Route::resource('categoria', CategoriaController::class)->middleware("auth");
Route::resource('grado', GradoController::class)->middleware("auth");
Route::resource('seccion', SeccionController::class)->middleware("auth");
Route::resource('grado-seccion', GradoSeccionController::class)->middleware("auth");


Auth::routes(['reset' => false]);

//redirigir al crud cuando acceda a home.
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Cuando el usuario se loguee, redirigir al crud del colaborador
Route::group(["middleware" => "auth"], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
