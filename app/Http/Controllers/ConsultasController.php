<?php

namespace App\Http\Controllers;
use App\Models\Consulta;
use App\Models\Especialista;
use App\Models\MensajeChat;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SalaChat;
use App\Models\Tarjeta;
use App\Models\Pago;
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
        $participante = new Participante();
        $participante->idPaticipante = $consulta->idCliente;
        $participante->idSala = $sala->id;
        $participante->save();
        $participante = new Participante();
        $especialista = Especialista::find($consulta->idEspecialista);
        $participante->idPaticipante = $especialista->idUsuario;
        $participante->idSala = $sala->id;
        $participante->save();
        $mensaje =new MensajeChat();
        $mensaje->idUsuario = $consulta->idCliente;
        $mensaje->mensaje = $consulta->consulta;
        $mensaje->idSalaChat = $sala->id;
        $mensaje->save();
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
    public function pagarConsulta(Request $request){
        $consulta = Consulta::find($request->idConsulta);
        $tarjeta = Tarjeta::find($request->idTarjeta);
        $especialista = Especialista::find($consulta->idEspecialista);
        $pago = new Pago();
        $pago->idConsulta=$request->idConsulta;
        $pago->idTarjeta = $request->idTarjeta;
        $pago->idCliente = $consulta->idCliente;
        $pago->idEspecialista = $especialista->idUsuario;
        $pago->save();
        $consulta->estado = 4;
        $consulta->save();
        return $pago;
    }
    public function terminarConsulta(Request $request){
        $consulta = Consulta::find($request->idSala);
        $usuario = User::find(Auth::user()->id);
        if($consulta->idCliente==$usuario->id){
            if( $consulta->estado==6){
                $consulta->estado=7;
                $consulta->save();
            }else{
                $consulta->estado=5;
                $consulta->save();
            }
        }else
        if($consulta->idEspecialista==$usuario->especialista->id){
            if( $consulta->estado==5){
                $consulta->estado=7;
                $consulta->save();
            }else{
                $consulta->estado=6;
                $consulta->save();
            }
        }
        return $consulta;
    }
}
