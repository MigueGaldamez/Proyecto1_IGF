<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\MensajeChat;


class NuevoChatMensaje implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mensajeChat;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MensajeChat $mensajeChat)
    {
        $this->mensajeChat =$mensajeChat;
        //
    }

    public function broadcastAs() {
        return 'mensaje.nuevo';
   }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.'.$this->mensajeChat->idSalaChat);
    }
}
