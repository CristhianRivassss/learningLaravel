<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El campo :attribute debe ser un correo electrónico válido.',
    'max' => [
        'string' => 'El campo :attribute no debe ser mayor que :max caracteres.',
    ],
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    // Puedes agregar más reglas aquí según lo necesites
    'attributes' => [
        'nombre' => 'nombre',
        'email' => 'correo electrónico',
        'mensaje' => 'mensaje',
    ],
];
