<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:usuarios,email',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'Este correo electrónico no está registrado.',
        ];
    }
}
