<?php

use Illuminate\Support\Facades\Route;
// Importamos los controladores:
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});

Route::resource('clientes', ClienteController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('mesas', MesaController::class);
Route::resource('reservas', ReservaController::class);


