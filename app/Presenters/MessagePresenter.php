<?php

namespace App\Presenters;
use App\Models\Message;

class MessagePresenter 
{
    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function userName(){
        return $this->message->user ? $this->message->user->name : 'Invitado';
    }
    public function userEmail(){
        return $this->message->email ? $this->message->email : 'Sin email';
    }

}