<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
class publicoController extends Controller
{
    //
    public function inicio(){
        return Inertia::render('Inicio');
    }
}
