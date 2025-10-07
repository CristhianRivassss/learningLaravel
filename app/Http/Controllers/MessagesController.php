<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use Carbon\Carbon;
use App\Models\Message;
use App\Http\Requests\CreateMessageRequest;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Messages;
use App\Repositories\CacheMessages;
use App\Repositories\MessagesInterface;
class MessagesController extends Controller
{
    protected $messages;

    public function __construct(MessagesInterface $messages)
    {
        $this->messages = $messages;
    }
 
    /**
     * Display a listing of the resource.
     */
    public function index()
      {
        $messages = $this->messages->getPaginated();
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
        // CreateMessageRequest ya validó automáticamente
        $validated = $request->validated();
        
        if (Auth::check()) {
            $validated['user_id'] = Auth::id();
        }



        $message = $this->messages->store($validated);
        event(new MessageSent($message)); 
        return redirect('/')->with('success', 'Mensaje enviado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $message = $this->messages->findById($id);
        return view('messages.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $message = $this->messages->findById($id);
        return view('messages.edit', ['message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->messages->update($id, $request);
        
        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->messages->destroy($id);
        return redirect()->route('mensajes.index')->with('info', 'Mensaje eliminado correctamente');
    }
}
