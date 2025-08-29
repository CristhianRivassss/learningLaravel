<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Middleware\example;

class PagesController extends \Illuminate\Routing\Controller
{
    use ValidatesRequests;
    
    public function __construct()
    {
        // Aplicar middleware a todos los métodos del controlador
        $this->middleware(example::class);
        
        // O aplicar solo a métodos específicos:
        // $this->middleware(example::class)->only(['saludos', 'contacto']);
        
        // O aplicar a todos excepto algunos:
        // $this->middleware(example::class)->except(['index']);
    }
    
    public function index()
    {
        return view('home');
    }

    public function contacto(Request $request)
    {
       return view('contacto');
    }
    public function mensajes(CreateMessageRequest $request){
        $data = $request->all();
        return redirect()->route('saludos', ['nombre' => $data['nombre']])->with('info', 'Mensaje enviado con exito');
    }




    public function saludos($nombre = "invitado")
    {
        $nombres = ['Juan', 'María', 'Pedro', 'Ana'];
        return view('saludo', ['nombre' => $nombre, 'nombres' => $nombres]);
    }
}
