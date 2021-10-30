<?php

namespace App\Http\Controllers;

use App\Models\Tarjeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TarjetaController extends Controller
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
        return Tarjeta::where('estado','=',1)->where('idUsuario','=',Auth::user()->id)->with('usuario')->paginate($per_page);
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
       
        $tarjeta = new Tarjeta();
        $tarjeta->create([
            'codigo'=>$request->codigo,
            'pin'=>$request->pin,
            'banco'=>$request->banco,
            'fechaVencimiento'=>$request->fechaVencimiento,
            'tipo'=>$request->tipo,
            'estado'=>1,
            'idUsuario'=>Auth::user()->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarjeta  $tarjeta
     * @return \Illuminate\Http\Response
     */
    public function show(Tarjeta $tarjeta)
    {
        //
        return $tarjeta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarjeta  $tarjeta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarjeta $tarjeta)
    {
        //
        $tarjeta->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarjeta  $tarjeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarjeta $tarjeta)
    {
        //
        $tarjeta->estado=2;
        $tarjeta->save();

    }
}
