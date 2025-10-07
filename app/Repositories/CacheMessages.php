<?php

namespace App\Repositories;
use App\Models\Message;
use Illuminate\Support\Facades\Cache;

class CacheMessages implements MessagesInterface
{   
    protected $messages;

    public function __construct(Messages $messages)
    {
        $this->messages = $messages;
    }

    public function getPaginated(){


        $currentPage = request('page', 1);
        $key = 'messages.page.' . $currentPage;

        // Cachear por página específica con tags
        return Cache::tags(['messages'])->rememberForever($key, function () use ($currentPage) {
            // Forzar la página específica en la consulta
            return $this->messages->getPaginated();
        });
    }
    public function store($validated){
        $message = $this->messages->store($validated);
        Cache::tags(['messages'])->flush(); // Limpiar cache después de crear
        return $message;
    }

    public function update($id, $request){
        $this->messages->update($id, $request);
        Cache::tags(['messages'])->flush(); // Limpiar cache después de actualizar
    }

    public function destroy($id){
        $this->messages->destroy($id);
        Cache::tags(['messages'])->flush(); // Limpiar cache después de eliminar
    }
        
    public function findById($id){
        return cache::rememberForever('message.' . $id, function () use ($id) {
            return $this->messages->findById($id);
        });
    }
}