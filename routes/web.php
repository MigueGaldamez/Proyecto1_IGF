<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\publicoController;

Route::get('/', function () {
    return Inertia::render('Publico/Inicio', [
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

Route::middleware(['auth:sanctum', 'verified'])->get('/consultas', function () {
    return Inertia::render('Consultas/Inicio');
})->name('consultas');

Route::middleware(['auth:sanctum', 'verified'])->get('/clientes', function () {
    return Inertia::render('Clientes/Inicio');
})->name('clientes');

Route::middleware(['auth:sanctum', 'verified'])->get('/asesores', function () {
    return Inertia::render('Especialistas/Inicio');
})->name('asesores');

Route::middleware(['auth:sanctum', 'verified'])->get('/realizarconsulta', function () {
    return Inertia::render('Consultas/RealizarConsulta');
})->name('realizarconsulta');

Route::middleware(['auth:sanctum', 'verified'])->get('/consultasrealizadas', function () {
    return Inertia::render('Consultas/ConsultasRealizadasCliente');
})->name('consultasrealizadas');

Route::middleware(['auth:sanctum', 'verified'])->get('/chat/salas',[ChatController::class, 'salas']);
Route::middleware(['auth:sanctum', 'verified'])->get('/chat/salas/{salaId}/mensajes',[ChatController::class, 'mensajes']);
Route::middleware(['auth:sanctum', 'verified'])->post('/chat/salas/{salaId}/mensaje',[ChatController::class, 'nuevoMensaje']);

Route::get('/inicio', function () {
    return Inertia::render('Publico/Inicio');
})->name('inicio');

Route::get('/informacion', function () {
    return Inertia::render('Publico/Informacion');
})->name('informacion');

Route::get('/contactanos', function () {
    return Inertia::render('Publico/Contactanos');
})->name('contactanos');

Route::get('/especialistas', function () {
    return Inertia::render('Publico/Especialistas');
})->name('especialistas');

Route::get('/iniciarSesion', function () {
    return Inertia::render('Publico/IniciarSesion');
})->name('iniciarSesion');

Route::get('/registro', function () {
    return Inertia::render('Publico/Registro');
})->name('registro');