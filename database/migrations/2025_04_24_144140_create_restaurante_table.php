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
        Schema::create('restaurante', function (Blueprint $table) {
            $table->id();
            $table->string('cif')->unique();
            $table->json('telfs');
            $table->string('descripcion');
            $table->string('email')->unique();

            // ✅ Solo mantenemos la ubicación
            $table->unsignedBigInteger('idUbicacion');
            $table->foreign('idUbicacion')->references('id')->on('ubicacion')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurante');
    }
};
