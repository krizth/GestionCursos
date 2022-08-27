<?php

use App\Http\Controllers\ArchivosController;
use App\Http\Controllers\AsignaturasController;
use App\Http\Controllers\ImparteController;
use App\Http\Controllers\SeccionesController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/asignaturas',AsignaturasController::class)->middleware('auth');
Route::resource('/secciones',SeccionesController::class)->middleware('auth');
Route::resource('/archivos',ArchivosController::class)->middleware('auth');
Route::delete('/imparte/{id_user?}/{id_asignatura?}',[
ImparteController::class,'destroy'
])->name('imparte.destroy');
Route::resource('/imparte',ImparteController::class,[
    'except'=>'destroy'
])->middleware('auth');
Route::get('/archivos/descargas/{file}',[ArchivosController::class,'downloads']);