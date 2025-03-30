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
            $table->id('reserva_id');

            $table->string('cliente_email');        // ajena a cliente
            $table->foreign('cliente_email')->references('email')->on('clientes')->onDelete('cascade');

            $table->unsignedBigInteger('mesa_id');      // ajena a mesa
            $table->foreign('mesa_id')->references('mesa_id')->on('mesas')->onDelete('cascade');

            $table->date('fechaReserva');       // campos de la tabla
            $table->time('horaReserva');
            $table->float('duracion');
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
