<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';
    protected $primaryKey = 'reserva_id';
    public $timestamps = true;

    protected $fillable = [
        'cliente_email',
        'mesa_id',
        'fechaReserva',
        'horaReserva',
        'duracion',
        'estado',
    ];

    public function cliente()       // relacion con cliente
    {
        return $this->belongsTo(Cliente::class, 'cliente_email', 'email');
    }

    public function mesa()      // relacion con mesa
    {
        return $this->belongsTo(Mesa::class, 'mesa_id', 'mesa_id');
    }


    public function agregarComensal()
    {
        // TODO: Implementar lógica de agregar comensal
        return false;
    }

    public function enviarNotificacion()
    {
        // TODO: Enviar notificación al cliente
    }
}
