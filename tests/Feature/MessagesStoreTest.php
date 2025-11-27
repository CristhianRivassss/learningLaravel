<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessagesStoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_persists_a_valid_message_request()
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
            'mensaje' => 'Hola mundo',
        ]);
    }

    /** @test */
    public function it_assigns_user_id_when_authenticated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

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
            'user_id' => $user->id,
        ]);
    }
    /** @test */
    public function it_deletes_a_message()
    {
        $user = User::factory()->create();
        $message = Message::factory()->withUser($user)->create();

        $response = $this->delete('/mensajes/' . $message->id);

        $response->assertRedirect(route('mensajes.index'));
        $this->assertDatabaseMissing('messages', [
            'id' => $message->id,
        ]);
    }

}
