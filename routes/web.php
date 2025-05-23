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
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CartaController;

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


Route::get('/carta', [CartaController::class, 'index'])->name('carta');
Route::get('/hamburguesa-del-mes', [CartaController::class, 'hamburguesaDelMes'])->name('hamburguesa-del-mes');

// Rutas para el perfil de usuario
Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil.index');
Route::put('/perfil/update', [App\Http\Controllers\PerfilController::class, 'update'])->name('perfil.update');
Route::put('/perfil/password', [App\Http\Controllers\PerfilController::class, 'updatePassword'])->name('perfil.password');



// Reservas routes
Route::get('/form-reservas', [ReservaController::class, 'create'])->name('form-reservas');
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');

// Pedidos routes
Route::get('/form-pedidos', [PedidoController::class, 'create'])->name('form-pedidos');
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');


// Authentication routes
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

Route::post('/login', [UsuarioController::class, 'checkLogin'])->name('login.attempt');;

Route::get('/registro', function () {
    return view('registro');
})->name('registro');

Route::post('/registro', [UsuarioController::class, 'store']);

// Admin routes
Route::get('/admin-pedidos', [PedidoController::class, 'index'])->middleware('admin.only')->name('pedidos.index');
Route::get('/admin-reservas', [ReservaController::class, 'index'])->middleware('admin.only')->name('reservas.index');
Route::get('/admin-clientes', [UsuarioController::class, 'index'])->middleware('admin.only')->name('usuarios.index');
Route::get('/admin-hamburguesas', [ProductoController::class, 'showAll'])->middleware('admin.only')->name('hamburguesas');
Route::delete('/admin-hamburguesas-delete/{id}', [ProductoController::class, 'destroy'])->middleware('admin.only')->name('hamburguesas.destroy');
Route::post('/admin-hamburguesas', [ProductoController::class, 'store'])->middleware('admin.only')->name('hamburguesas.store');
Route::post('/admin-hamburguesas-update/{id}', [ProductoController::class, 'update'])->middleware('admin.only')->name('hamburguesas.update');


// Resource routes
Route::resource('clientes', ClienteController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('mesas', MesaController::class);
Route::resource('reservas', ReservaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('alergenos', AlergenoController::class);
Route::resource('lineapedidos', LineaPedidoController::class);
