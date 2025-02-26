<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoMesa{
    const Reservada = "Reservada";
    const Disponible = "Disponible";
}

class Mesa extends Model
{
    /** @use HasFactory<\Database\Factories\MesaFactory> */
    use HasFactory;

    // int
    private $idMesa;
    // Date
    private $fechaReserva; // esto es innecesario? ya que reserva tiene la fecha
    // int
    private $capacidad;
    // Time
    private $horaReserva; // igual que en fechaReserva
    // EstadoMesa
    private $estado;

    function reservarMesa(){
        // todo
        return false;
    }

    function liberarMesa(){
        // todo
        return false;
    }
}
