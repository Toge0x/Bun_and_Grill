<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;

    // InfoPago
    private $pago;
    // int
    private $puntos;
    // array Pedido
    private $pedidos;
    // array Alergeno
    private $alergenos;

    function __construct($pago, $puntos, $pedidos, $alergenos)
    {
        $this->pago = $pago;
        $this->puntos = $puntos;
        $this->pedidos = $pedidos;
        $this->alergenos = $alergenos;
    }

    function crearReserva(){
        // Código para crear una reserva
        // todo
        return false;
    }

    function registrarInfoPago(){
        // Código para registrar la información de pago
        // todo
    }

    function registrarAlergenos(){
        // Código para registrar los alergenos
        // todo
    }

    function getPedidos(){
        // Código para obtener los pedidos
        // todo
        // return arrayPedidos
    }

    function getAlergenos(){
        // Código para obtener los alergenos
        // todo
        // return arrayAlergenos
    }


}
