<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
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
                'imagen' => null,
            ],
            [
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
            ],
            [
                'nombre' => 'BBQ Crunch',
                'ingredientes' => [
                    'Doble carne de res',
                    'Queso Cheddar',
                    'Cebolla crujiente',
                    'Salsa BBQ',
                    'Pan rústico',
                ],
                'precio' => 9.50,
                'imagen' => null,
            ],
            [
                'nombre' => 'Veggie Delight',
                'ingredientes' => [
                    'Hamburguesa de garbanzos',
                    'Rúcula',
                    'Tomate',
                    'Cebolla caramelizada',
                    'Salsa de yogur',
                    'Pan integral',
                ],
                'precio' => 8.90,
                'imagen' => null,
            ],
            [
                'nombre' => 'Picante Extreme',
                'ingredientes' => [
                    'Carne de res picante',
                    'Jalapeños',
                    'Queso Pepper Jack',
                    'Salsa chipotle',
                    'Lechuga',
                ],
                'precio' => 10.80,
                'imagen' => null,
            ],
            [
                'nombre' => 'Doble Bacon',
                'ingredientes' => [
                    'Doble carne de res',
                    'Doble bacon',
                    'Queso Cheddar',
                    'Salsa especial',
                    'Pan brioche',
                ],
                'precio' => 11.20,
                'imagen' => null,
            ],
            [
                'nombre' => 'Trufa Deluxe',
                'ingredientes' => [
                    'Hamburguesa de ternera premium',
                    'Queso Gouda',
                    'Salsa de trufa',
                    'Rúcula',
                    'Pan artesanal',
                ],
                'precio' => 12.50,
                'imagen' => null,
            ],
            [
                'nombre' => 'Pollo Crispy',
                'ingredientes' => [
                    'Pechuga de pollo empanizada',
                    'Lechuga',
                    'Mayonesa',
                    'Tomate',
                    'Pan con ajonjolí',
                ],
                'precio' => 8.20,
                'imagen' => null,
            ],
            [
                'nombre' => 'Smoky BBQ',
                'ingredientes' => [
                    'Carne de cerdo desmechada',
                    'Queso Provolone',
                    'Cebolla morada',
                    'Salsa BBQ ahumada',
                    'Pan de masa madre',
                ],
                'precio' => 9.80,
                'imagen' => null,
            ],
            [
                'nombre' => 'Especial de la Casa',
                'ingredientes' => [
                    'Carne de res premium',
                    'Queso suizo',
                    'Cebolla caramelizada',
                    'Salsa secreta',
                    'Pan brioche',
                ],
                'precio' => 11.90,
                'imagen' => null,
            ],
            [
                'nombre' => 'Fingers de Pollo',
                'ingredientes' => [
                    'Tiras de pollo empanizadas',
                    'Salsa de mostaza y miel',
                    'Lechuga',
                    'Tomate',
                ],
                'precio' => 6.50,
                'imagen' => null,
            ],
            [
                'nombre' => 'Aros de Cebolla',
                'ingredientes' => [
                    'Cebolla rebozada y frita',
                    'Salsa de ajo',
                ],
                'precio' => 4.50,
                'imagen' => null,
            ],
            [
                'nombre' => 'Patatas Fritas',
                'ingredientes' => [
                    'Papas fritas crujientes',
                    'Sal',
                ],
                'precio' => 3.00,
                'imagen' => null,
            ],
            [
                'nombre' => 'Cerveza Artesanal',
                'ingredientes' => [
                    'Cerveza de elaboración local',
                ],
                'precio' => 4.00,
                'imagen' => null,
            ],
            [
                'nombre' => 'Refresco',
                'ingredientes' => [
                    'Bebida carbonatada',
                ],
                'precio' => 2.50,
                'imagen' => null,
            ],
            [
                'nombre' => 'Batido de Chocolate',
                'ingredientes' => [
                    'Leche',
                    'Helado de chocolate',
                    'Sirope de chocolate',
                ],
                'precio' => 5.00,
                'imagen' => null,
            ],
            [
                'nombre' => 'Tarta de Queso',
                'ingredientes' => [
                    'Base de galleta',
                    'Relleno de queso crema',
                    'Mermelada de frutas del bosque',
                ],
                'precio' => 4.50,
                'imagen' => null,
            ]

        ];

        foreach ($productos as $data) {
            Producto::firstOrCreate(['nombre' => $data['nombre']], $data);
        }
    }
}
