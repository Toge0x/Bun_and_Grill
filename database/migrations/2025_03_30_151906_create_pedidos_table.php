<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id(); // id del pedido

            $table->string('cliente_email');        // relacion con cliente
            $table->foreign('cliente_email')->references('email')->on('clientes')->onDelete('cascade');

            $table->date('fecha');
            $table->enum('estado', ['Pendiente', 'En preparación', 'Listo', 'Entregado'])->default('Pendiente');
            $table->decimal('total', 8, 2)->default(0);     // total del pedido

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
