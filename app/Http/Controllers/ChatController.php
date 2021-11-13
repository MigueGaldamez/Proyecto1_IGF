<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaChat;
use App\Models\MensajeChat;
use Illuminate\Support\Facades\Auth;
use App\Events\NuevoChatMensaje;
use App\Models\Participante;

class ChatController extends Controller
{
    //
    public function salas(Request $request){
        $salas = Participante::where('idPaticipante','=',Auth::user()->id)->pluck('idSala');
        return SalaChat::whereIn('id',$salas)->with('consulta')->get();
    }
    public function mensajes(Request $request, $salaId){
        return MensajeChat::where('idSalaChat',$salaId)->with('usuario')
        ->orderBy('created_at','ASC')
        ->get();
        //return MensajeChat::all();
    }
    public function nuevoMensaje(Request $request, $salaId){
        $nuevoMensaje = new MensajeChat;
        $nuevoMensaje->idUsuario = Auth::id();
        $nuevoMensaje->IdSalaChat = $salaId;
        $nuevoMensaje->mensaje = $request->mensaje;
     
        $nuevoMensaje->save();

        broadcast(new NuevoChatMensaje($nuevoMensaje))->toOthers();
        return $nuevoMensaje;
    }   
}
