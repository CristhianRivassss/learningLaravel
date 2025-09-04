<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     * Solo admins pueden ver lista de usuarios
     */
    public function viewAny(User $user): bool
    {
        return $user->can('admin-only');
    }

    /**
     * Determine whether the user can view the model.
     * Solo puede ver su propio perfil O ser admin
     */
    public function view(User $user, User $model): bool
    {
        return $user->id === $model->id || $user->can('admin-only');
    }

    /**
     * Determine whether the user can create models.
     * Solo admins pueden crear usuarios
     */
    public function create(User $user): bool
    {
        return $user->can('admin-only');
    }

    /**
     * Determine whether the user can update the model.
     * Solo puede editar su propio perfil O ser admin
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id || $user->can('admin-only');
    }

    /**
     * Determine whether the user can delete the model.
     * Solo admins pueden eliminar usuarios (y no pueden eliminarse a sí mismos)
     */
    public function delete(User $user, User $model): bool
    {
        return $user->can('admin-only') && $user->id !== $model->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
