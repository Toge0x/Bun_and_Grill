<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categoria', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('idCarta');
            $table->timestamps();

            $table->foreign('idCarta')->references('id')->on('carta')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categoria');
    }
};
