<?php

namespace Tests\Feature\integration;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EloquentMessagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Repositorio real que queremos probar (app/Repositories/Messages).
     *
     * @var \App\Repositories\Messages
     */
    protected $repo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = $this->app->make(\App\Repositories\Messages::class);
    }

    /** @test */
    public function it_returns_paginated_messages()
    {
        // Given: existen 15 mensajes en la BD de prueba
        Message::factory()->count(15)->create(['created_at' => Carbon::yesterday()]);
        //dump(Message::all()->toArray()); // Depuración temporal para ver los registros creados

        // When: obtenemos la paginación desde el repositorio
        $paginator = $this->repo->getPaginated();

        // Then: recibimos un paginador válido
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertCount(10, $paginator->items()); // paginate(10) por implementación
        $this->assertSame(15, $paginator->total()); // total acumulado
    }
}
