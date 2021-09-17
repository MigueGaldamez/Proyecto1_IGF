<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SalaChat;
use App\Models\User;

class MensajeChat extends Model
{
    use HasFactory;
    protected $table = 'mensajeChat';

    public function sala(){
        return $this->hasOne(SalaChat::class,'id','idSalaChat');
    }
    
    public function usuario(){
        return $this->hasOne(User::class,'id','idUsuario');
    }
}
