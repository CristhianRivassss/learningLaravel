<?php

namespace App\Repositories;
use App\Models\Message;
use Illuminate\Support\Facades\Cache;

class Messages
{

      public function getPaginated(){
        $currentPage = request('page', 1);
        $key = 'messages.page.' . $currentPage;

        // Cachear por página específica con tags
        $messages = Cache::tags(['messages'])->rememberForever($key, function () use ($currentPage) {
            // Forzar la página específica en la consulta
            return Message::paginate(10, ['*'], 'page', $currentPage);
        });
        
        return $messages;
      }
      public function store($validated){
        $message = Message::create($validated);
        Cache::tags(['messages'])->flush(); // Limpiar caché al crear un nuevo mensaje

        return $message;
    }
    public function findById($id){
        return Message::findOrFail($id);
    }
    public function update($id, $request){
       Message::findOrFail($id)->update($request->only([
            'nombre',
            'email',
            'telefono',
            'mensaje',
        ]));
        Cache::tags(['messages'])->flush(); // Limpiar caché al actualizar un mensaje
    }
    public function destroy($id){
         Message::findOrFail($id)->delete();
         Cache::tags(['messages'])->flush(); // Limpiar caché al eliminar un mensaje
    }
}