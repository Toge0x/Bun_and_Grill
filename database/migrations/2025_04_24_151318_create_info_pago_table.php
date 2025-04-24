<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('info_pago', function (Blueprint $table) {
            $table->id();
            $table->string('emailCliente')->unique(); // Relación 1:1
            $table->string('numTarjeta');
            $table->string('caducidad'); // puede cambiarse por $table->date('caducidad') si se prefiere
            $table->string('cvv');
            $table->string('titular');
            $table->timestamps();

            $table->foreign('emailCliente')->references('email')->on('clientes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('info_pago');
    }
};
