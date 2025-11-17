<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class MessageSent implements ShouldBroadcast
{
    use SerializesModels;

    public Message $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * The channel the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('messages');
    }

    /**
     * Data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'nombre' => $this->message->nombre,
            'email' => $this->message->email,
            'mensaje' => $this->message->mensaje,
            'user_id' => $this->message->user_id ?? null,
            'created_at' => optional($this->message->created_at)->toDateTimeString(),
        ];
    }

    /**
     * Optional: event name on the client.
     */
    public function broadcastAs(): string
    {
        return 'message.sent';
    }
}
