<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'   => 'required|string|max:255',
            'apellidos'=> 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email|max:255', // Validación de email único
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',    // una mayuscula
                'regex:/[0-9]/',    // un numero
                'confirmed',        // debe coincidir con password_confirmationm
            ],
            'telefono' => 'nullable|string|max:15',
            'direccion'=> 'nullable|string|max:255',
            'sexo'     => 'nullable|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula y un dígito.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];
    }
}
