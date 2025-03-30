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
        Schema::create('cliente_alergenos', function (Blueprint $table) {
            $table->id();
            $table->string('cliente_email');
            $table->unsignedBigInteger('alergeno_id');
        
            $table->foreign('cliente_email')->references('email')->on('clientes')->onDelete('cascade');
            $table->foreign('alergeno_id')->references('id')->on('alergenos')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_alergenos');
    }
};
