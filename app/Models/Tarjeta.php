<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function usuario(){
        return $this->belongsTo (User::class,'idUsuario','id');
    }
}
