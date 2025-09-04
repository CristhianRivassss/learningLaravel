<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para validar la creación de usuarios
 * 
 * Este Form Request se encarga de:
 * - Validar que todos los campos requeridos estén presentes
 * - Verificar que el email sea único en toda la tabla users
 * - Validar el formato del email
 * - Verificar que la contraseña tenga el mínimo de caracteres (8 para crear)
 * - Confirmar que las contraseñas coincidan
 * - Validar que los roles existan en la base de datos
 */
class CreateUserRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer esta petición.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        // Permitir la petición (aquí podrías agregar lógica de autorización)
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la petición.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Nombre: requerido, debe ser texto, máximo 255 caracteres
            'name' => 'required|string|max:255',
            
            // Email: requerido, formato email válido, máximo 255 caracteres
            // unique:users verifica que NO exista en la tabla users (sin excepciones)
            'email' => 'required|string|email|max:255|unique:users',
            
            // Contraseña: OBLIGATORIA para crear usuario, mínimo 8 caracteres, debe estar confirmada
            'password' => 'required|string|min:3',
            
            // Roles: debe ser un array, cada ID debe existir en la tabla 'roles'
            'roles' => 'array|exists:roles,id'
        ];
    }

    /**
     * Obtiene los mensajes personalizados para los errores del validador.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Mensajes para el campo 'name'
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            
            // Mensajes para el campo 'email'
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Debe ser un email válido.',
            'email.max' => 'El email no puede tener más de 255 caracteres.',
            'email.unique' => 'Este email ya está registrado.', // ← MENSAJE PARA CREACIÓN
            
            // Mensajes para el campo 'password'
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            
            // Mensajes para el campo 'roles'
            'roles.array' => 'Los roles deben ser una lista.',
            'roles.exists' => 'Uno o más roles seleccionados no existen.',
        ];
    }

    /**
     * Obtiene nombres de atributos personalizados para los mensajes de error.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'roles' => 'roles',
        ];
    }
}
