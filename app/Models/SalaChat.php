<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MensajeChat;

class SalaChat extends Model
{
    use HasFactory;
    protected $table = 'salaChat';
    protected $with = ['ultimoMensaje'];
    public function mensajes(){
        return $this->hasMany(MensajeChat::class);
    }
    public function consulta(){
        return $this->hasOne(Consulta::class, 'idSala','id');
    }
    public function ultimoMensaje(){
        return $this->hasMany(MensajeChat::class,'idSalaChat','id');
    }
}
