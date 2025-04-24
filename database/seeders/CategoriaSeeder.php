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
            'nombre' => 'Hamburguesas',
            'idCarta' => 1
        ]);

        $veggies = Categoria::firstOrCreate([
            'nombre' => 'Vegetarianas',
            'idCarta' => 1
        ]);

        $pollo = Categoria::firstOrCreate([
            'nombre' => 'Pollo',
            'idCarta' => 1
        ]);

        $especiales = Categoria::firstOrCreate([
            'nombre' => 'Especiales',
            'idCarta' => 1
        ]);

        // Asignar productos a sus categorías
        $mapeo = [
            'Clásica' => $hamburguesas->id,
            'Quesada' => $hamburguesas->id,
            'BBQ Crunch' => $hamburguesas->id,
            'Picante Extreme' => $hamburguesas->id,
            'Doble Bacon' => $hamburguesas->id,
            'Trufa Deluxe' => $especiales->id,
            'Especial de la Casa' => $especiales->id,
            'Veggie Delight' => $veggies->id,
            'Pollo Crispy' => $pollo->id,
            'Smoky BBQ' => $especiales->id,
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
