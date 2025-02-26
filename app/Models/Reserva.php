<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    /** @use HasFactory<\Database\Factories\ReservaFactory> */
    use HasFactory;

    // int
    private $idReserva;
    // Date
    private $fechaReserva;
    // Time
    private $horaReserva;
    // Cliente
    private $cliente;
    // Mesa
    private $mesa;
    // EstadoReserva
    private $estado;

    function agregarComensal(){
        // todo
        return false;
    }

    function enviarNotificacion(){

    }
}
