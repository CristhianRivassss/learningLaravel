<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Carbon\Carbon;
use App\Models\Message;


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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'mensaje' => 'required|string|min:2',
        ]);

        Message::create($validated);

        return redirect('/');
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
