<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Especialista;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

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
            'fechaInicio'=>date('Y-m-d'),
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
}
