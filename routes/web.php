<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

Route::get('/',[PagesController::class, 'index']);

Route::get('contacto', [PagesController::class, 'contacto'])->name('contacto');
Route::post('contacto', [PagesController::class, 'mensajes']);
Route::get('saludos/{nombre?}', [PagesController::class, 'saludos'])->name('saludos');