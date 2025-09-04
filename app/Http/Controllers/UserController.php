<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Verificar que el usuario puede ver la lista de usuarios
        
        // Obtener todos los usuarios con sus roles
        $users = User::with('roles')->paginate(15);
        return view('usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verificar que el usuario puede crear usuarios (solo admins)
        $this->authorize('create', User::class);
        
        // Obtener todos los roles disponibles
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        // Verificar que el usuario puede crear usuarios (solo admins)
        $this->authorize('create', User::class);
        
        // Ya no necesitas validar aquí, el Form Request lo hace automáticamente
        // Solo obtienes los datos ya validados
        $validated = $request->validated();

        // Crear el usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Asignar roles si se seleccionaron
        if (isset($validated['roles'])) {
            $user->roles()->attach($validated['roles']);
        }

    return redirect()->route('usuarios.index')
                        ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        
        // Verificar que el usuario puede ver este perfil (propio perfil o admin)
        $this->authorize('view', $user);
        
        return view('usuarios.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        
        // Verificar que el usuario puede editar este perfil (su propio perfil O es admin)
        $this->authorize('update', $user);
        
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        
        return view('usuarios.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        
        // Verificar que el usuario puede actualizar este perfil
        $this->authorize('update', $user);
        
        // Ya no necesitas validar aquí, el Form Request lo hace automáticamente
        // Solo obtienes los datos ya validados
        $validated = $request->validated();

        // Actualizar datos básicos
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Actualizar password solo si se proporciona
        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        // Sincronizar roles (elimina los antiguos y agrega los nuevos)
        if (isset($validated['roles'])) {
            $user->roles()->sync($validated['roles']);
        } else {
            $user->roles()->detach(); // Remover todos los roles
        }

        return redirect()->route('usuarios.index')
                        ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        // Verificar que el usuario puede eliminar este usuario
        $this->authorize('delete', $user);
        
        // Desasignar todos los roles antes de eliminar
        $user->roles()->detach();
        
        // Eliminar el usuario
        $user->delete();

        return redirect()->route('usuarios.index')
                        ->with('success', 'Usuario eliminado exitosamente.');
    }
}
