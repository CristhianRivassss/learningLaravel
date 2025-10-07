<?php

namespace App\Repositories;
use App\Models\Message;
use Illuminate\Support\Facades\Cache;

class Messages implements MessagesInterface
{

      public function getPaginated(){
            return Message::paginate(10);
      }
      public function store($validated){
        $message = Message::create($validated);
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
    }
    public function destroy($id){
         Message::findOrFail($id)->delete();
    }
}