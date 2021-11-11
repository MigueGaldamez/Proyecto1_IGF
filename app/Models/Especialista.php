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
        'idUsuario',
        'reconocimiento',
        'tituloGraduado',
        'fechaInicio',
        'estado',
    ];
    protected $with = ['usuario','especialidad'];
    public function usuario(){
        return $this->belongsTo (User::class,'idUsuario','id');
    }
    public function especialidad(){
        return $this->belongsTo (Especialidad::class,'idEspecialidad','id');
    }
    public function pagos(){
        return $this->hasMany (Pago::class,'idEspecialista','idUsuario');
    }
}