<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('valoracion', function (Blueprint $table) {
            $table->id();
            $table->text('comentario');
            $table->integer('valor');
            $table->date('fecha');

            $table->string('emailCliente'); // FK a clientes.email
            $table->unsignedBigInteger('idRestaurante'); // FK a restaurante.id

            $table->timestamps();

            $table->foreign('emailCliente')->references('email')->on('clientes')->onDelete('cascade');
            $table->foreign('idRestaurante')->references('id')->on('restaurante')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('valoracion');
    }
};
