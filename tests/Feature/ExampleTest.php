<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * Este es un test mínimo de ejemplo: hace una petición GET a la ruta raíz '/'
     * y verifica que la respuesta HTTP sea 200 (OK).
     * Puedes abrir tests/Feature para ver más pruebas o duplicar/editar este archivo.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
