<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'telefono' => $this->faker->phoneNumber(),
            'direccion' => $this->faker->address(),
            'sexo' => $this->faker->randomElement(['Masculino', 'Femenino', 'Otro']),
        ];
    }
}
