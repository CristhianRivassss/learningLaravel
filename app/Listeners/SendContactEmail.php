<?php

namespace App\Listeners;

use App\Events\MessageSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendContactEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        $message = $event->message;

        // Aquí puedes usar el servicio de correo que prefieras, por ejemplo, Mailgun, Postmark, SES, etc.
        // Asegúrate de configurar el servicio en config/services.php y .env

    Log::info('Enviando correo para el mensaje: ' . $message->id);
    }
}
