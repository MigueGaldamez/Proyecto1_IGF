<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\publicoController;
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
    return Inertia::render('Inicio', [
        'canLogin' => Route::has('IniciarSesion'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    return Inertia::render('Chat/contenedor');
})->name('chat');


Route::middleware(['auth:sanctum', 'verified'])->get('/chat/salas',[ChatController::class, 'salas']);
Route::middleware(['auth:sanctum', 'verified'])->get('/chat/salas/{salaId}/mensajes',[ChatController::class, 'mensajes']);
Route::middleware(['auth:sanctum', 'verified'])->post('/chat/salas/{salaId}/mensaje',[ChatController::class, 'nuevoMensaje']);

Route::get('/inicio', function () {
    return Inertia::render('Inicio');
})->name('inicio');

Route::get('/informacion', function () {
    return Inertia::render('Informacion');
})->name('informacion');

Route::get('/contactanos', function () {
    return Inertia::render('Contactanos');
})->name('contactanos');

Route::get('/especialistas', function () {
    return Inertia::render('Especialistas');
})->name('especialistas');

Route::get('/iniciarSesion', function () {
    return Inertia::render('IniciarSesion');
})->name('iniciarSesion');

Route::get('/registro', function () {
    return Inertia::render('Registro');
})->name('registro');