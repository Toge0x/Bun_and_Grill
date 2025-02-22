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
            $table->foreign('cliente_email')->references('email')->on('clientes')->onDelete('cascade');
    
            $table->enum('alergeno', [
                'Gluten', 'Crustáceos', 'Huevos', 'Pescado', 'Cacahuetes', 
                'Soja', 'Lácteos', 'Frutos_con_cascara', 'Apio', 'Mostaza', 
                'Sésamo', 'Sulfitos', 'Altramuces', 'Moluscos'
            ]);

            $table->timestamps();
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
