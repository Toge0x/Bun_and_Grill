<?php

use Illuminate\Support\Facades\Route;
// Importamos los controladores:
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('home');
});

Route::get('/hamburguesa-del-mes', function () {
    return view('hamburguesa-del-mes');
});

Route::get('/carta', function () {
    return view('carta');
})->name('carta');

Route::get('/reservas', function () {
    return view('reservas');
});

Route::get('/contactanos', function () {
    return view('contactanos');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/admin', function () {
    return view('dashboard');
});

Route::get('/admin-reservas', function () {
    return view('listado-reservas');
});

Route::get('/admin-pedidos', function () {
    return view('pedidos');
});

Route::get('/admin-clientes', function () {
    return view('clientes');
});

Route::get('/admin-hamburguesas', function () {
    return view('hamburguesas');
});




/*
// Rutas del panel de administración
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Reservas
    Route::resource('reservas', 'ReservaController');

    // Clientes
    Route::resource('clientes', 'ClienteController');

    // Pedidos
    Route::resource('pedidos', 'PedidoController');

    // Hamburguesas
    Route::resource('hamburguesas', 'HamburguesaController');

    // Configuración
    Route::get('configuracion', function () {
        return view('admin.configuracion');
    })->name('configuracion');
});
*/

Route::resource('clientes', ClienteController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('mesas', MesaController::class);
Route::resource('reservas', ReservaController::class);
Route::resource('productos', ProductoController::class);

