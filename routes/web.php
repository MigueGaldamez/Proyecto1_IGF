<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\publicoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\TarjetaController;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\PagoController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/consulta', function () {
    return Inertia::render('Consultas/Inicio');
})->name('consultas');

Route::middleware(['auth:sanctum', 'verified'])->get('/clientesver', function () {
    return Inertia::render('Clientes/Inicio');
})->name('clientesver');
/*
Route::middleware(['auth:sanctum', 'verified'])->get('/asesores', function () {
    return Inertia::render('Especialistas/Inicio');
})->name('asesores');
*/

//API MIO------AQUI ESTA LA DIRECCION DE LA PAGINA
Route::apiResource('/consultas', ConsultasController::class );
//VISTA MIA
Route::middleware(['auth:sanctum', 'verified'])->get('/realizarconsulta', function () {
    return Inertia::render('Consultas/RealizarConsulta');
})->name('realizarconsulta');



Route::middleware(['auth:sanctum', 'verified'])->get('/consultasrealizadas', function () {
    return Inertia::render('Consultas/ConsultasRealizadasCliente');
})->name('consultasrealizadas');
Route::middleware(['auth:sanctum', 'verified'])->get('/consultaspendientes', function () {
    return Inertia::render('Consultas/ConsultasEspecialista');
})->name('consultaspendientes');


Route::middleware(['auth:sanctum', 'verified'])->get('/pagos', function () {
    return Inertia::render('Especialistas/VerPagos');
})->name('pagos');

Route::middleware(['auth:sanctum', 'verified'])->get('/solicitudes', function () {
    return Inertia::render('Especialistas/Solicitudes');
})->name('solicitudes');

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

Route::get('/especialistasPublico', function () {
    return Inertia::render('Publico/Especialistas');
})->name('especialistas');

Route::get('/iniciarSesion', function () {
    return Inertia::render('Publico/IniciarSesion');
})->name('iniciarSesion');

Route::get('/registro', function () {
    return Inertia::render('Publico/Registro');
})->name('registro');

//CRUDS
Route::middleware(['auth:sanctum', 'verified'])->apiResource('/tipoUsuarios', TipoUsuarioController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/cruds/tipoUsuario', function () {
    return Inertia::render('TipoUsuario/Inicio');
})->name('tipoUsuario.index');

Route::middleware(['auth:sanctum', 'verified'])->apiResource('/clientes', ClienteController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/cruds/clientes', function () {
    return Inertia::render('Cliente/Inicio');
})->name('cliente.index');

Route::apiResource('/especialidads', EspecialidadController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/cruds/especialidades', function () {
    return Inertia::render('Especialidad/Inicio');
})->name('especialidad.index');

Route::middleware(['auth:sanctum', 'verified'])->apiResource('/tarjetas', TarjetaController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/cruds/tarjetas', function () {
    return Inertia::render('Tarjeta/Inicio');
})->name('tarjeta.index');

//API
Route::apiResource('/especialistas', EspecialistaController::class);
//VISTAS
Route::middleware(['auth:sanctum', 'verified'])->get('/cruds/especialistas', function () {
    return Inertia::render('Especialistas/Inicio');
})->name('asesores');

Route::middleware(['auth:sanctum', 'verified'])->post('/terminar/consulta',[ConsultasController::class, 'terminarConsulta']);
Route::middleware(['auth:sanctum', 'verified'])->post('/pagar/consulta',[ConsultasController::class, 'pagarConsulta']);
Route::middleware(['auth:sanctum', 'verified'])->get('/pagos/ver',[PagoController::class, 'verPagos']);
Route::middleware(['auth:sanctum', 'verified'])->post('/abrir/chat/',[EspecialistaController::class, 'chatAbrirPost']);
Route::middleware(['auth:sanctum', 'verified'])->get('/abrir/chat/',[EspecialistaController::class, 'chatAbrirGet']);
Route::middleware(['auth:sanctum', 'verified'])->get('/obtener/usuario',[EspecialistaController::class, 'obtenerUsuario']);

Route::middleware(['auth:sanctum', 'verified'])->post('/solicitud/aceptar/',[EspecialistaController::class, 'cambiarEstado']);
Route::middleware(['auth:sanctum', 'verified'])->post('/solicitud/rechazar/',[EspecialistaController::class, 'cambiarEstadono']);
Route::middleware(['auth:sanctum', 'verified'])->get('/solicitud/pendientes',[EspecialistaController::class, 'soliciudesPe']);
Route::middleware(['auth:sanctum', 'verified'])->get('/consultas/cliente/ver',[ConsultasController::class, 'consultasCliente']);
Route::middleware(['auth:sanctum', 'verified'])->get('/consultas/especialista/ver',[ConsultasController::class, 'consultasEspecialista']);
Route::middleware(['auth:sanctum', 'verified'])->post('/consulta/precio',[ConsultasController::class, 'asignarPrecio']);
Route::middleware(['auth:sanctum', 'verified'])->post('/sala/nueva',[ConsultasController::class, 'salaNueva']);
Route::middleware(['auth:sanctum', 'verified'])->get('/obtener/especialista',[EspecialistaController::class, 'obtenerEspecialista']);
Route::middleware(['auth:sanctum', 'verified'])->post('/editar/perfil/especialista',[EspecialistaController::class, 'editarPerfil'])->name('editarPerfil');