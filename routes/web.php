<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MessagesController;

Route::get('/',[PagesController::class, 'index']);

Route::get('contacto', [PagesController::class, 'contacto'])->name('contacto');
Route::post('contacto', [PagesController::class, 'mensajes']);
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
Route::resource('mensajes', MessagesController::class);