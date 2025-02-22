<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->string('email')->primary();         // clave primaria email (apunta a Usuarios)
            $table->foreign('email')->references('email')->on('usuarios')->onDelete('cascade');     // clave foránea a usuarios.email
            $table->integer('puntos')->default(0);      // puntos a 0 por defecto
            // falta implementar InfoPago, no necesario para 1ª entrega !!!
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
