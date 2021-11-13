<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Tarjeta extends Model
{
    use HasFactory;
    protected $table = 'tarjeta';

    protected $fillable = [
        'codigo',
        'pin',
        'banco',
        'fechaVencimiento',
        'estado',
        'idUsuario',
        'tipo',
    ];
    protected $appends=['fecha_vencimiento'];

 
    public function getFechaVencimientoAttribute($value)
    {
       
        return carbon::parse($this->attributes['fechaVencimiento'])->format('m/y');
    }
    public function usuario(){
        return $this->belongsTo (User::class,'idUsuario','id');
    }
   
}
