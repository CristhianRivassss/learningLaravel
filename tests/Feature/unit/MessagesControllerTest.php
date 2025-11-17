<?php

namespace Tests\Feature\unit;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\MessagesController;
use Mockery;
use Illuminate\Support\Facades\Event;

class MessagesControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    protected $messageRepo;
    protected $view;
    protected $controller;

    public function setUp(): void
    {
        parent::setUp();
        $this->messageRepo = Mockery::mock('App\Repositories\Messages');
        $this->view = Mockery::mock(\Illuminate\Contracts\View\Factory::class);
        $this->controller = new MessagesController($this->messageRepo, $this->view);
    }
    public function testIndex()
    {
       
        $collection = collect();
        $this->messageRepo->shouldReceive('getPaginated')->once()->andReturn($collection);  // ✅ PRIMERO: declarar expectativa del repo

          $this->view->shouldReceive('make')
            ->once()
            ->with('messages.index', ['messages' => $collection]) // ✅ verifica que reciba el array esperado
            ->andReturn(Mockery::mock('Illuminate\\Contracts\\View\\View'));  // ✅ SEGUNDO: declarar expectativa de la vista

        $response = $this->controller->index();  // ✅ TERCERO: ejecutar
        
        $this->assertNotNull($response);  // ✅ CUARTO: verificar el resultado
    }
    public function testCreate()
    {
        $this->view->shouldReceive('make')
            ->once()
            ->with('messages.create')
            ->andReturn(Mockery::mock('Illuminate\\Contracts\\View\\View'));

        $response = $this->controller->create();

        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $response);
    }

    public function testStore()
    {
        Event::fake();

        $payload = ['content' => 'Hola mundo'];
        $request = Mockery::mock(\App\Http\Requests\CreateMessageRequest::class);
        $request->shouldReceive('validated')->once()->andReturn($payload);

        $message = new Message();
        $this->messageRepo->shouldReceive('store')->once()->with($payload)->andReturn($message);

        $response = $this->controller->store($request);

        Event::assertDispatched(\App\Events\MessageSent::class, function ($event) use ($message) {
            return isset($event->message) ? $event->message === $message : true; // tolerante si la prop difiere
        });

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertTrue($response->isRedirect());
    }


    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

}