<?php

namespace App\Http\Controllers;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SalaChat;

class ConsultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //AQUI SE TRABAJA CON LOS MODELOS
    public function index(Request $request)
    {       
        $data = Consulta::with('cliente','especialista','salaChat')->paginate($request->per_page);
        return $data;
    }
    public function consultasCliente(Request $request)
    {        
        $data = Consulta::where('idCliente','=',Auth::user()->id)->with('cliente','especialista','salaChat')->paginate($request->per_page);
        return $data;
    }
    public function consultasEspecialista(Request $request)
    {   
        $usuario = User::find(Auth::user()->id);
        
        $data = Consulta::where('idEspecialista','=',$usuario->especialista->id)->with('cliente','especialista','salaChat')->paginate($request->per_page);
        return $data;
    }
    public function asignarPrecio(Request $request){
        $consulta = Consulta::find($request->idConsulta);
        $consulta->estado = 2;
        $consulta->precio = $request->precio;
        $consulta->save();
        return "exito";
    }
    public function salaNueva(Request $request){
        $consulta = Consulta::find($request->idSala);
        $sala = new SalaChat();
        $sala->nombreSala = $consulta->titulo;
        $sala->save();
        $consulta->idSala = $sala->id;
        $consulta->save();
        return "exito";
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consulta=new Consulta();
        $consulta->titulo = $request->titulo;
        $consulta->consulta = $request->consulta;
        $consulta->idEspecialista = $request->idEspecialista;
        $consulta->idCliente = Auth::user()->id;
        $consulta->estado = 1;
        $consulta->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Consulta $consulta)
    {
        return $consulta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consulta $consulta)
    {
        $consulta=$consulta;
        $consulta->titulo = $request->titulo;
        $consulta->consulta = $request->consulta;
        $consulta->idEspecialista = $request->idEspecialista;       
        $consulta->estado = 1;
        $consulta->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consulta $consulta)
    {
        $consulta->delete();
    }
}
