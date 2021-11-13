<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Pago extends Model
{
    use HasFactory;
    protected $fillable = [
        'idConsulta',
        'idTarjeta',
        'idCliente',
        'idEspecialista',
     
    ];
    protected $with = ['cliente','especialista','tarjeta','consulta'];
    public function cliente(){
        return $this->belongsTo (User::class,'idCliente','id');
    }
    public function especialista(){
        return $this->belongsTo (User::class,'idEspecialista','id');
    }
    public function tarjeta(){
        return $this->belongsTo(tarjeta::class,'idTarjeta','id');
    }
    public function consulta(){
        return $this->belongsTo(Consulta::class,'idConsulta','id');
    }
    public function getCreatedAtAttribute($value){
        return carbon::parse($value)->format('d/m/Y');
    }
}
