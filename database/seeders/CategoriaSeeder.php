<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Producto;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        // Crear categorías asociadas a la carta 1
        $hamburguesas = Categoria::firstOrCreate([
            'nombre' => 'hamburguesas',
            'idCarta' => 1
        ]);

        $entrantes = Categoria::firstOrCreate([
            'nombre' => 'entrantes',
            'idCarta' => 1
        ]);

        $bebidas = Categoria::firstOrCreate([
            'nombre' => 'bebidas',
            'idCarta' => 1
        ]);

        $postres = Categoria::firstOrCreate([
            'nombre' => 'postres',
            'idCarta' => 1
        ]);

        // Asignar productos a sus categorías
        $mapeo = [
            'Clásica' => $hamburguesas->id,
            'Quesada' => $hamburguesas->id,
            'BBQ Crunch' => $hamburguesas->id,
            'Picante Extreme' => $hamburguesas->id,
            'Doble Bacon' => $hamburguesas->id,
            'Trufa Deluxe' => $hamburguesas->id,
            'Especial de la Casa' => $hamburguesas->id,
            'Veggie Delight' => $hamburguesas->id,
            'Pollo Crispy' => $hamburguesas->id,
            'Smoky BBQ' => $hamburguesas->id,
            'Fingers de Pollo' => $entrantes->id,
            'Aros de Cebolla' => $entrantes->id,
            'Patatas Fritas' => $entrantes->id,
            'Cerveza Artesanal' => $bebidas->id,
            'Refresco' => $bebidas->id,
            'Batido de Chocolate' => $postres->id,
            'Tarta de Queso' => $postres->id,
        ];

        foreach ($mapeo as $nombre => $idCategoria) {
            $producto = Producto::where('nombre', $nombre)->first();
            if ($producto) {
                $producto->idCategoria = $idCategoria;
                $producto->save();
            }
        }
    }
}
