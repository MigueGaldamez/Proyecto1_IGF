<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }
    public function verPagos(Request $request){
       
        $usuario = User::find(Auth::user()->id);
        if($usuario->especialista){
            if($request->mes!=0 || $request->anio!=0){
                if($request->mes!=0 && $request->anio!=0){
                    $fechaQ = $request->anio.'-'.$request->mes.'-1';
                    $pagos = Pago::where('idEspecialista','=',$usuario->id)->whereBetween('created_at',[
                        date('Y-m-01', strtotime($fechaQ)),
                        date('Y-m-t', strtotime($fechaQ))
                        ])->get();
                    return  $pagos;
                }else if($request->anio!=0){
                    $fechaQ = $request->anio.'-01-01';
                    $pagos = Pago::where('idEspecialista','=',$usuario->id)->whereBetween('created_at',[
                        date('Y-01-01', strtotime($fechaQ)),
                        date('Y-12-t', strtotime($fechaQ))
                        ])->get();
                    return $pagos;
                }
            }
            else{
                $pagos = Pago::where('idEspecialista','=',$usuario->id)->get();
                return  $pagos;
            }         
        }else{
            if($request->mes!=0 || $request->anio!=0){
                if($request->mes!=0 && $request->anio!=0){
                    $fechaQ = $request->anio.'-'.$request->mes.'-1';
                    $pagos = Pago::where('idCliente','=',$usuario->id)->whereBetween('created_at',[
                        date('Y-m-01', strtotime($fechaQ)),
                        date('Y-m-t', strtotime($fechaQ))
                        ])->get();
                    return  $pagos;
                }else if($request->anio!=0){
                    $fechaQ = $request->anio.'-01-01';
                    $pagos = Pago::where('idCliente','=',$usuario->id)->whereBetween('created_at',[
                        date('Y-01-01', strtotime($fechaQ)),
                        date('Y-12-t', strtotime($fechaQ))
                        ])->get();
                    return $pagos;
                }
            }
            else{
                $pagos = Pago::where('idCliente','=',$usuario->id)->get();
                return  $pagos;
            }
        } 
    }
}
