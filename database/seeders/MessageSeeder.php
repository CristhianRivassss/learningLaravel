<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunos mensajes de ejemplo
        Message::create([
            'nombre' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'telefono' => '123456789',
            'mensaje' => 'Hola, este es un mensaje de prueba.',
            'user_id' => null, // Mensaje sin usuario asignado
        ]);

        Message::create([
            'nombre' => 'María García',
            'email' => 'maria@example.com',
            'telefono' => '987654321',
            'mensaje' => 'Otro mensaje de ejemplo.',
            'user_id' => User::first()->id ?? null, // Asignar al primer usuario si existe
        ]);

        Message::create([
            'nombre' => 'Carlos López',
            'email' => 'carlos@example.com',
            'telefono' => '555666777',
            'mensaje' => 'Mensaje adicional para testing.',
            'user_id' => User::inRandomOrder()->first()->id ?? null, // Usuario aleatorio
        ]);

        // Crear 10 mensajes adicionales usando un bucle
        for ($i = 0; $i < 100; $i++) {
            Message::create([
                'nombre' => 'Usuario ' . ($i + 1),
                'email' => 'usuario' . ($i + 1) . '@example.com',
                'telefono' => '12345678' . $i,
                'mensaje' => 'Mensaje automático número ' . ($i + 1),
                'user_id' => User::inRandomOrder()->first()->id ?? null,
            ]);
        }
    }
}