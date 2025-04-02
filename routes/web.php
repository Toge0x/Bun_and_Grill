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

Route::get('/admin', function () {
    return view('listado-reservas');
})->name('admin-reservas');

//Route::get('/admin', [ReservaController::class, 'showAll']);

Route::get('/admin-pedidos', function () {
    return view('pedidos');
});

Route::get('/admin-clientes', function () {
    return view('clientes');
});

Route::get('/admin-clientes', [UsuarioController::class, 'showAll']);

/*
// Esto se puede eliminar, ya que se usa la siguiente ruta
Route::get('/admin-hamburguesas', function () {
    return view('hamburguesas');
});
*/

Route::get('/admin-hamburguesas', [ProductoController::class, 'showAll'])->name('hamburguesas');

Route::delete('/admin-hamburguesas-delete/{id}', [ProductoController::class, 'destroy'])->name('hamburguesas.destroy');

Route::post('/admin-hamburguesas', [ProductoController::class, 'store'])->name('hamburguesas.store');

Route::post('/admin-hamburguesas-update/{id}', [ProductoController::class, 'update'])->name('hamburguesas.update');

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

Route::resource('pedidos', PedidoController::class);
Route::resource('alergenos', AlergenoController::class);
Route::resource('lineapedidos', LineaPedidoController::class);
