<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use Carbon\Carbon;
use App\Models\Message;
use App\Http\Requests\CreateMessageRequest;
use App\Models\User;

class MessagesController extends Controller
{
 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages=Message::all();
        return view('messages.index', ['messages' => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMessageRequest $request)
    {
        // Ya no necesitas validate() - CreateMessageRequest lo hace automáticamente
        $validated = $request->validated();
        if (Auth::check()) {
            // Agregar el ID del usuario autenticado
            $validated['user_id'] = Auth::id();
        }

        Message::create($validated);

        return redirect('/')->with('success', 'Mensaje enviado correctamente');
    /*     $message= new Message;
        $message->nombre=$request->input('nombre');
        $message->email=$request->input('email');
        $message->telefono=$request->input('telefono');
        $message->mensaje=$request->input('mensaje');
        $message->save();

        ]));

        return redirect('/');
    /*     $message= new Message;
        $message->nombre=$request->input('nombre');
        $message->email=$request->input('email');
        $message->telefono=$request->input('telefono');
        $message->mensaje=$request->input('mensaje');
        $message->save();
 
        
       /*  DB::table('messages')->insert([
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'mensaje' => $request->input('mensaje'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); */
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
        $message = Message::findOrFail($id);
        return view('messages.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $message = Message::findOrFail($id);
        return view('messages.edit', ['message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $message = Message::findOrFail($id);
        $message->update($request->only([
            'nombre',
            'email',
            'telefono',
            'mensaje'
        ]));
        
        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Message::findOrFail($id)->delete();
        return redirect()->route('mensajes.index')->with('info', 'Mensaje eliminado correctamente');
    }
}
