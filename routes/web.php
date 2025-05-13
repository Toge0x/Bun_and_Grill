<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AlergenoController;
use App\Http\Controllers\LineaPedidoController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

// Contact routes
Route::get('/contact', function () {
    return view('form-contacto');
})->name('form-contacto');
Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');

Route::get('/hamburguesa-del-mes', function () {
    return view('hamburguesa-del-mes');
})->name('hamburguesa-del-mes');

Route::get('/carta', function () {
    return view('carta');
})->name('carta');

// Reservas routes
Route::get('/form-reservas', [ReservaController::class, 'create'])->name('form-reservas');
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::get('/admin-reservas', [ReservaController::class, 'index'])->name('reservas.index');

// Pedidos routes
Route::get('/form-pedidos', [PedidoController::class, 'create'])->name('form-pedidos');
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
Route::get('/admin-pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

// Authentication routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [UsuarioController::class, 'checkLogin']);

Route::get('/registro', function () {
    return view('registro');
})->name('registro');

Route::post('/registro', [UsuarioController::class, 'store']);

// Admin routes
Route::get('/admin-clientes', [UsuarioController::class, 'index'])->name('usuarios.index');

Route::get('/admin-hamburguesas', [ProductoController::class, 'showAll'])->name('hamburguesas');
Route::delete('/admin-hamburguesas-delete/{id}', [ProductoController::class, 'destroy'])->name('hamburguesas.destroy');
Route::post('/admin-hamburguesas', [ProductoController::class, 'store'])->name('hamburguesas.store');
Route::post('/admin-hamburguesas-update/{id}', [ProductoController::class, 'update'])->name('hamburguesas.update');

// Resource routes
Route::resource('clientes', ClienteController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('mesas', MesaController::class);
Route::resource('reservas', ReservaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('alergenos', AlergenoController::class);
Route::resource('lineapedidos', LineaPedidoController::class);

// -------------------------------
//   RESERVAS
// -------------------------------

// Mostrar formulario (sólo usuarios autenticados)
Route::get('/form-reservas', [ReservaController::class, 'create'])
     ->name('form-reservas')
     ->middleware('auth');

// Procesar envío (sólo usuarios autenticados)
Route::post('/reservas', [ReservaController::class, 'store'])
     ->name('reservas.store')
     ->middleware('auth');

// Listado admin (público o protegido según tu lógica)
Route::get('/admin-reservas', [ReservaController::class, 'index'])->name('reservas.index');

// Resource complementario (omitimos create y store porque ya están arriba)
Route::resource('reservas', ReservaController::class)
     ->except(['create','store']);

// -------------------------------
//   PEDIDOS
// -------------------------------

// Mostrar formulario (sólo usuarios autenticados)
Route::get('/form-pedidos', [PedidoController::class, 'create'])
     ->name('form-pedidos')
     ->middleware('auth');

// Procesar envío (sólo usuarios autenticados)
Route::post('/pedidos', [PedidoController::class, 'store'])
     ->name('pedidos.store')
     ->middleware('auth');

// Listado admin
Route::get('/admin-pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

// Resource complementario (omitimos create y store porque ya están arriba)
Route::resource('pedidos', PedidoController::class)
     ->except(['create','store']);
