<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Permitir mass assignment para estos campos
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'mensaje'
    ];
}
