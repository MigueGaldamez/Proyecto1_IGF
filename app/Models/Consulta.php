<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

//AQUI SE TRABAJA CON EL NOMBRE DE LA TABLA
class Consulta extends Model
{
    use HasFactory;
    protected $table = 'consultas';
    protected $fillable = [
        'idEspecialista',
        'idCliente',
        'titulo',
        'consulta',
        'idSala'
    ];
    public function cliente(){
        return $this->belongsTo(User::class,'idCliente','id');
    }
    public function especialista(){
        return $this->belongsTo(Especialista::class,'idEspecialista','id');
    }
    public function salaChat(){
        return $this->hasOne(SalaChat::class,'id','idSala');
    }
    public function getCreatedAtAttribute($value)
    {
        return carbon::parse($value)->format('D d-m-Y');
    }
}
