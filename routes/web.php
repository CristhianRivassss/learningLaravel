<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MessagesController;

Route::get('/',[PagesController::class, 'index']);

Route::get('contacto', [PagesController::class, 'contacto'])->name('contacto');
Route::post('contacto', [PagesController::class, 'mensajes']);
Route::get('saludos/{nombre?}', [PagesController::class, 'saludos'])->name('saludos');

Route::get('mensajes',[MessagesController::class, 'index'])->name('mensajes.index');
Route::get('mensajes/create',[MessagesController::class, 'create'])->name('mensajes.create');
Route::post('mensajes/store',[MessagesController::class, 'store'])->name('mensajes.store');
