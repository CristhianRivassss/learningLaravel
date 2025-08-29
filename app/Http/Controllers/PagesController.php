<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\CreateMessageRequest;
class PagesController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        return view('home');
    }

    public function contacto(Request $request)
    {
       return view('contacto');
    }
    public function mensajes(CreateMessageRequest $request){
        return $request->all();
    }




    public function saludos($nombre = "invitado")
    {
        $nombres = ['Juan', 'María', 'Pedro', 'Ana'];
        return view('saludo', ['nombre' => $nombre, 'nombres' => $nombres]);
    }
}
