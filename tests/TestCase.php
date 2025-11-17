<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    // Esta clase es la base para todas tus pruebas.
    // Aquí puedes añadir configuración común, traits o métodos de ayuda.
    // Ejemplo (descomentarlo si quieres que cada test resetee la BD):
    // use \Illuminate\Foundation\Testing\RefreshDatabase;
    //
    // También puedes definir un setUp() para inicializar cosas antes de cada prueba:
    // protected function setUp(): void
    // {
    //     parent::setUp();
    //     // inicializaciones comunes
    // }
}
