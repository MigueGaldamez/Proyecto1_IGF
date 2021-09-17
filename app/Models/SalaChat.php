<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MensajeChat;

class SalaChat extends Model
{
    use HasFactory;
    protected $table = 'salaChat';

    public function mensajes(){
        return $this->hasMany(MensajeChat::class);
    }
}
