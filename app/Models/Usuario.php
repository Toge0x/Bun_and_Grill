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
    /** @use HasFactory<\Database\Factories\UsuarioFactory> */
    use HasFactory;

    private $nombre;

    private $apellidos;

    private $email;

    private $password;

    private $telefono;

    private $direccion;

    private $genero;

    function __construct($nombre, $apellidos, $email, $password, $telefono, $direccion, $genero)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->password = $password;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->genero = $genero;
    }

    function registrarUsuario(){
        // Código para registrar un usuario
        // Todo: Implementar
        return false;
    }

    function autenticarUsuario(){
        // Código para autenticar un usuario
        // Todo: Implementar
        return false;
    }
}
