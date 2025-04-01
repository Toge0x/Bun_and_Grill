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

    public static function borrarUsuario($id)
    {
        $usuarios = self::find($id);
        if ($usuarios) {
            $usuarios->delete();
            return ['message' => 'Usuario no borrada'];
        }
        return ['message' => 'Usuario no encontrado'];
    }

    public static function actualizarUsuario($id, $datos)
    {
    $usuarios = self::find($id);
    if ($usuarios) {
        $usuarios->update($datos);
        return $usuarios;
    }
    return ['message' => 'Usuario no actualizada'];
    }

    public function leerUsuario($id){
        $usuarios = self::find($id);
        if($usuarios){
            return  $usuarios;
        }
        return ['message' => 'Usuario no leida'];
    }

    public function leerTodosUsuarios(){
        $usuarios = self::all();
        if($usuarios){
            return  $usuarios;
        }
        return ['message' => 'Usuario no leida'];
    }

    public function crearUsuario($datos)
    {
        $usuarios = self::create($datos);
        if($usuarios){
            return  $usuarios;
        }
        return ['message' => 'Usuario no creada'];
    }
}
