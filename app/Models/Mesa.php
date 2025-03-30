<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    protected $table = 'mesas';
    protected $primaryKey = 'mesa_id';
    public $timestamps = true;

    protected $fillable = [
        'capacidad',
        'estado',
    ];

    // Relaciones

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'mesa_id', 'mesa_id');
    }

    // Métodos adicionales opcionales (no obligatorios para funcionar)

    public function reservarMesa()
    {
        $this->estado = 'Reservada';
        $this->save();
    }

    public function liberarMesa()
    {
        $this->estado = 'Disponible';
        $this->save();
    }
}
