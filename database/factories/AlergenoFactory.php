<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlergenoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->randomElement([
                'Gluten', 'Lácteos', 'Pescado', 'Huevos', 'Soja'
            ]),
        ];
    }
}
