<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use App\Http\Requests\TipoUsuarioRequest;
class TipoUsuarioController extends Controller
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
        return TipoUsuario::paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoUsuarioRequest $request)
    {
        //
        $tipoUsuario = new TipoUsuario();
        $tipoUsuario->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(TipoUsuario $tipoUsuario)
    {
        //
        return $tipoUsuario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(TipoUsuarioRequest $request, TipoUsuario $tipoUsuario)
    {
        //
        $tipoUsuario->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoUsuario $tipoUsuario)
    {
        //
        $tipoUsuario->delete();
    }
}
