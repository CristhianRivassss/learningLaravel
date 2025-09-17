<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\LoggingController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
/* DB::listen(function ($query) {
    echo "<pre>($query->sql)</pre>";
}); */
// Quitar middleware 'can:admin-only' - La Policy se encarga de los permisos
Route::middleware(['auth'])->group(function () {
    // Ruta resource completa para gestión de usuarios
    // UserPolicy manejará los permisos: propio perfil O admin
    Route::resource('usuarios', UserController::class);
});


Route::get('roles', function(){
    return Role::with('users')->get();
});




Route::get('/',[PagesController::class, 'index']);
Route::get('saludos/{nombre?}', [PagesController::class, 'saludos'])->name('saludos');





/* 
Route::get('mensajes',[MessagesController::class, 'index'])->name('mensajes.index');
Route::get('mensajes/create',[MessagesController::class, 'create'])->name('mensajes.create');
Route::post('mensajes/store',[MessagesController::class, 'store'])->name('mensajes.store');
Route::get('mensajes/{id}',[MessagesController::class, 'show'])->name('mensajes.show');
Route::get('mensajes/{id}/edit',[MessagesController::class, 'edit'])->name('mensajes.edit');
Route::put('mensajes/{id}',[MessagesController::class, 'update'])->name('mensajes.update');
Route::delete('mensajes/{id}',[MessagesController::class, 'destroy'])->name('mensajes.destroy');
 */

Route::resource('mensajes', MessagesController::class)->middleware('auth')->only(['index']);
Route::resource('mensajes', MessagesController::class)->except(['index']);

/* LOGGING */
Route::get('login', [LoggingController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoggingController::class, 'login'])->name('login.post');
Route::post('logout', [LoggingController::class, 'logout'])->name('logout');



/* Usuarios */

/* Route::resource('usuarios', UsersController::class); */
/* Route::get('test',function(){
    $user = new User;
    $user->name = 'Rivas';
    $user->email = 'cris@gmail.com';
    $user->password = bcrypt('123456');
    $user->role = 'moderador';
    $user->save();
    return 'User created successfully'.$user->all();
}); */