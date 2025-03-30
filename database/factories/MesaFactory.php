<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MesaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'capacidad' => $this->faker->randomElement([2, 4, 6, 8]),
            'estado' => $this->faker->randomElement(['Disponible', 'Reservada']),
        ];
    }
}
