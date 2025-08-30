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

        Message::create($request->only([
            'nombre',
            'email',
            'telefono',
            'mensaje'
        ]));

        return redirect()->route('mensajes.index');
    /*     $message= new Message;
        $message->nombre=$request->input('nombre');
        $message->email=$request->input('email');
        $message->telefono=$request->input('telefono');
        $message->mensaje=$request->input('mensaje');
        $message->save();
 */
        
       /*  DB::table('messages')->insert([
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'mensaje' => $request->input('mensaje'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); */
        return redirect()->route('mensajes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = DB::table('messages')->where('id', $id)->first();
        return view('messages.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $message = DB::table('messages')->where('id',$id)->first();
        return view('messages.edit', ['message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('messages')->where('id', $id)->update([
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'mensaje' => $request->input('mensaje'),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('messages')->where('id', $id)->delete();
        return redirect()->route('mensajes.index')->with('info', 'Mensaje eliminado correctamente');
    }
}
