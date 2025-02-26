<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergeno{
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

class Cliente_Alergenos extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;

    // int
    private $idAlergeno;
    // alergeno enum
    private $alergeno;

    function __construct($idAlergeno, $alergeno)
    {
        $this->idAlergeno = $idAlergeno;
        $this->alergeno = $alergeno;
    }

    function agregarAlergeno(){
        // Código para agregar un alergeno
        // todo
        return false;
    }
}
