<?php

namespace App\Listeners;

use App\Events\NuevoChatMensaje;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EnviarMensajeChatNotificacion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NuevoChatMensaje $event
     * @return void
     */
    public function handle(NuevoChatMensaje $event)
    {
        //
    }
}
