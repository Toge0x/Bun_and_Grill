<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UsuarioSeeder::class,
            ClienteSeeder::class,
            AlergenoSeeder::class,
            ClienteAlergenoSeeder::class,
            MesaSeeder::class,
            ReservaSeeder::class,
            ProductoSeeder::class,
            PedidoSeeder::class,
            AdministradorSeeder::class,
            UbicacionSeeder::class,
            RestauranteSeeder::class,
            CartaSeeder::class,
            CategoriaSeeder::class,
            ValoracionSeeder::class,
            InfoPagoSeeder::class,
        ]);
    }

}