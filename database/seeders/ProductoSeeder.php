<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Clásica',
            'ingredientes' => [
                'Hamburguesa de ternera',
                'Lechuga',
                'Tomate',
                'Pepinillos',
                'Pan brioche',
                'Ketchup',
            ],
            'precio' => 7.40,
            'imagen' => null, // cuando tengamos imagenes las ponemos
        ]);

        Producto::create([
            'nombre' => 'Quesada',
            'ingredientes' => [
                'Hamburguesa de ternera rellena de queso Edam',
                'Queso Cheddar',
                'Lechuga',
                'Salsa de mostaza y miel',
                'Bacon',
            ],
            'precio' => 10.30,
            'imagen' => null,
        ]);
    }
}
