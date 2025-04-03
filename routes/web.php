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

Route::get('/hamburguesa-del-mes', function () {
    return view('hamburguesa-del-mes');
});

Route::get('/carta', function () {
    return view('carta');
})->name('carta');

Route::get('/reservas', function () {
    return view('reservas');
});

Route::get('/usuario-pedido', function () {
    return view('usuario-pedido');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [UsuarioController::class, 'checkLogin']);

Route::get('/registro', function () {
    return view('registro');
})->name('registro');

Route::post('/registro', [UsuarioController::class, 'store']);

Route::get('/admin-reservas', [ReservaController::class, 'index'])->name('reservas.index');

Route::get('/admin-pedidos', function () {
    return view('pedidos');
});

Route::get('/admin-pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

Route::get('/admin-clientes', [UsuarioController::class, 'index'])->name('usuarios.index');

Route::get('/admin-hamburguesas', [ProductoController::class, 'showAll'])->name('hamburguesas');

Route::delete('/admin-hamburguesas-delete/{id}', [ProductoController::class, 'destroy'])->name('hamburguesas.destroy');

Route::post('/admin-hamburguesas', [ProductoController::class, 'store'])->name('hamburguesas.store');

Route::post('/admin-hamburguesas-update/{id}', [ProductoController::class, 'update'])->name('hamburguesas.update');

Route::resource('clientes', ClienteController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('mesas', MesaController::class);
Route::resource('reservas', ReservaController::class);
Route::resource('productos', ProductoController::class);

Route::resource('pedidos', PedidoController::class);
Route::resource('alergenos', AlergenoController::class);
Route::resource('lineapedidos', LineaPedidoController::class);
