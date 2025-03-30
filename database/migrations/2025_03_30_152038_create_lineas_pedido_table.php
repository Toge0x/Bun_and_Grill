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
        Schema::create('lineas_pedido', function (Blueprint $table) {
            $table->id('idLineaPedido');
            
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
        
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('idProducto')->on('productos')->onDelete('cascade');
        
            $table->integer('cantidad')->default(1);
            $table->decimal('subtotal', 8, 2);
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineas_pedido');
    }
};
