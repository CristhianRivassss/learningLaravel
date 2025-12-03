<?php

namespace Tests\Feature\functional;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateMessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_can_view_the_message_form(): void
    {
        $response = $this->get('/mensajes/create');

        $response->assertStatus(200);
        $response->assertSee('Enviar');
    }

    /** @test */
    public function a_guest_can_submit_a_message(): void
    {
        $payload = [
            'nombre' => 'Juan',
            'email' => 'juan@example.com',
            'telefono' => '555-1234',
            'mensaje' => 'Hola mundo',
        ];

        $response = $this->post('/mensajes', $payload);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('messages', [
            'nombre' => 'Juan',
            'email' => 'juan@example.com',
            'telefono' => '555-1234',
        ]);
    }
}
