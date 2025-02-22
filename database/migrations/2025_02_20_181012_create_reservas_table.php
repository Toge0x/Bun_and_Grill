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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id('reserva_id');           // clave primaria correcta
            $table->string('cliente_email');    // clave ajena a clientes
            $table->foreign('cliente_email')->references('email')->on('clientes')->onDelete('cascade');
            
            $table->unsignedBigInteger('mesa_id');  // clave ajena a mesas
            $table->foreign('mesa_id')->references('mesa_id')->on('mesas')->onDelete('cascade');
        
            $table->date('fechaReserva');
            $table->time('horaReserva');
            $table->integer('duracion');
            $table->enum('estado', ['Finalizada', 'Reservada']);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
