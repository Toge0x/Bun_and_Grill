<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'email';
    public $incrementing = false;       // porque la primary key no es un entero
    protected $keyType = 'string';

    protected $fillable = [
        'email',
        'puntos',
    ];

    // RELACIONES

    public function reservas()  // 1 a N, cliente tiene muchas reservas
    {
        return $this->hasMany(Reserva::class, 'cliente_email', 'email');
    }

    public function alergenos()
    {
        return $this->belongsToMany(Alergeno::class, 'cliente_alergenos', 'cliente_email', 'alergeno_id');
    }    

    public function usuario()   // 1 a 1 con usuario, herencia
    {
        return $this->hasOne(Usuario::class, 'email', 'email');
    }
}
