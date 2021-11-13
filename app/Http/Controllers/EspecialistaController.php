<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Especialidad;
use App\Models\Especialista;
use App\Models\SalaChat;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class EspecialistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $per_page=$request->per_page;
        return Especialista::with('usuario','especialidad')->paginate($per_page);
    }
    public function soliciudesPe(Request $request)
    {
        //
        $per_page=$request->per_page;
        return Especialista::where('estado','=',1)->with('usuario','especialidad')->paginate($per_page);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $usuario = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'idTipoUsuario'=>2,
            
        ]);
        $especialidad = Especialidad::find($request->especialidad);
        $especialista = Especialista::create([
            'idUsuario'=>$usuario->id,
            'idEspecialidad'=>$request->especialidad,
            'reconocimiento'=>$request->codigoProfesional,
            'tituloGraduado'=>$especialidad->nombre,
            'estado'=>1,
            'fechaInicio'=>date('Y-m-d'),
            'estado'=>1,
        ]);    
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Especialista  $especialista
     * @return \Illuminate\Http\Response
     */
    public function show(Especialista $especialista)
    {
        //
        return $especialista;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Especialista  $especialista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especialista $especialista)
    {
        
        $especialistaE = Especialista::find($request->id);
        $usuarioE = User::find($especialistaE->idUsuario);
        $especialistaE->idEspecialidad = $request->especialidad;
        $especialistaE->reconocimiento = $request->codigoProfesional;
        $especialistaE->save();
        $especialistaE->estado=$request->estado;
        $usuarioE->name = $request->name;
        $usuarioE->email = $request->email;
        $usuarioE->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Especialista  $especialista
     * @return \Illuminate\Http\Response
     */
    public function destroy(Especialista $especialista)
    {
        //
        $especialistaE = Especialista::find($especialista->id);
        $usuarioE = User::find($especialista->idUsuario);
      
        $especialistaE->delete();
        $usuarioE->delete();
    }
    public function cambiarEstado(Request $request){
       
        $especialistaE = Especialista::find($request->idUsuario);
        $usuarioE = User::find($especialistaE->idUsuario);
        $especialistaE->estado =2;
        $especialistaE->save();
    }
    public function cambiarEstadono(Request $request){
       
        $especialistaE = Especialista::find($request->idUsuario);
        $usuarioE = User::find($especialistaE->idUsuario);
        $especialistaE->estado =3;
        $especialistaE->save();
    }
    public function obtenerEspecialista(Request $request){
        $usuario = User::find(Auth::user()->id);
        if($usuario->especialista){
            return $usuario->especialista;
        }else{
            return 0;
        }
    }
    public function editarPerfil(Request $request){
        $usuario = User::find(Auth::user()->id);
        $usuario->especialista->reconocimiento = $request->codigoProfesional;
        $usuario->especialista->idEspecialidad = $request->especialidad;
        $usuario->especialista->save();
        return "exito";
    }
    public function chatAbrirPost(Request $request){
        
        $sala= Session::put('idSala',$request->idSala);
        return $sala;
    }
    public function chatAbrirGet(){
        $sala = Session::get('idSala');
        $consulta = Consulta::find($sala);
        if($consulta){
            $salachat = SalaChat::with('consulta')->find($consulta->idSala);
            Session::forget('idSala');
            return $salachat;
        }else{
            return 0;
        }
    }
    public function obtenerUsuario(){
        $usuario = User::with('tarjetas')->find(Auth::user()->id);
        if($usuario->especialista){
            return  $usuario = User::with('tarjetas','especialista')->find(Auth::user()->id);
        }else{
            return $usuario = User::with('tarjetas')->find(Auth::user()->id);
        }  
    }
}

