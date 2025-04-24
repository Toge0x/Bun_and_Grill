<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('administrador', function (Blueprint $table) {
            $table->id();
            $table->string('emailUsuario')->unique();
            $table->unsignedBigInteger('idRestaurante')->nullable(); // FK a restaurante
            $table->timestamps();

            $table->foreign('emailUsuario')->references('email')->on('usuarios')->onDelete('cascade');
            $table->foreign('idRestaurante')->references('id')->on('restaurante')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('administrador', function (Blueprint $table) {
            $table->dropForeign(['emailUsuario']);
            $table->dropForeign(['idRestaurante']);
        });
        Schema::dropIfExists('administrador');
    }
};
