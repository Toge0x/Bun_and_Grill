<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(2, true),
            'ingredientes' => $this->faker->randomElements([    // ingredientes ficticios, luego le metemos los que queramos
                'Queso', 'Tomate', 'Pan', 'Pollo', 'Lechuga', 'Cebolla', 'Salsa', 'Bacon'
            ], rand(2, 5)),
            'precio' => $this->faker->randomFloat(2, 3, 20),
            'imagen' => $this->faker->imageUrl(640, 480, 'food', true),
        ];
    }
}
