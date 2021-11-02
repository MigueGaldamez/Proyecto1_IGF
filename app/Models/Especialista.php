<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;
    protected $table = 'especialista';
    protected $fillable = [
        'idEspecialidad',
        'idNombre',
        'Correo',
        'Contraseña',
        'Confirmar Contraseña',
        'Codigo Profesional',
    ];

    public function usuario(){
        return $this->belongsTo (User::class,'idNombre','id');
    }
    public function especialidad(){
        return $this->belongsTo (Especialidad::class,'idEspecialidad','id');
    }
}