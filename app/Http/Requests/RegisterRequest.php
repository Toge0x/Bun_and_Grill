<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'    => ['required','string','max:255'],
            'apellidos' => ['required','string','max:255'],
            'email'     => ['required','email','max:255','unique:usuarios,email'],
            'password'  => ['required','confirmed', Password::min(8)->letters()->numbers()],
            'telefono'  => ['nullable','string','max:15'],
            'direccion' => ['nullable','string','max:255'],
            'sexo'      => ['nullable', Rule::in(['Masculino','Femenino','Otro'])],
        ];
    }

    public function messages()
    {
        return [
            'email.unique'       => 'Este correo ya está en uso.',
            'password.min'       => 'La contraseña debe tener al menos 8 caracteres.',
            'password.letters'   => 'La contraseña debe incluir al menos una letra.',
            'password.numbers'   => 'La contraseña debe incluir al menos un número.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'sexo.in'            => 'El valor de sexo seleccionado no es válido.',
        ];
    }
}
