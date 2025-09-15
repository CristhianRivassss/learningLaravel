<?php

namespace App\Models;
Use \App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Permitir mass assignment para estos campos
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'mensaje',
        'user_id'
    ];

    /**
     * Relación con el modelo User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function notes(){
        return $this->morphOne(Note::class, 'notable');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
