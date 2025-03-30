<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergeno extends Model
{
    use HasFactory;

    protected $table = 'alergenos';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = false;

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_alergenos', 'alergeno_id', 'cliente_email');
    }

    const Gluten = 'Gluten';
    const Crustaceos = 'Crustaceos';
    const Huevos = 'Huevos';
    const Pescado = 'Pescado';
    const Cacahuetes = 'Cacahuetes';
    const Soja = 'Soja';
    const Lacteos = 'Lacteos';
    const FrutosCascara = 'FrutosCascara';
    const Apio = 'Apio';
    const Mostaza = 'Mostaza';
    const Sesamo = 'Sesamo';
    const AzufreYSulfitos = 'AzufreYSulfitos';
    const Altramuces = 'Altramuces';
    const Moluscos = 'Moluscos';
}
