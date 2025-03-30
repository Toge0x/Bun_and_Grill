<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero {
    const Masculino = 'Masculino';
    const Femenino = 'Femenino';
    const Otro = 'Otro';
}

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'email';
    public $incrementing = false;       // primary key no es un numero
    protected $keyType = 'string';

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'password',
        'telefono',
        'direccion',
        'sexo',
    ];

    public function cliente()   // relacion 1:1 con cliente, herencia
    {
        return $this->belongsTo(Cliente::class, 'email', 'email');
    }

    public function registrarUsuario()      // metodos a implementar
    {
        return false;
    }

    public function autenticarUsuario()
    {
        return false;
    }
}
