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
        Schema::create('detalles_pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPedido');
            $table->unsignedBigInteger('idProducto');
            $table->integer('cantidad');
            $table->float('subtotal');
            $table->foreign('idPedido')->references('id')->on('pedidos');
            $table->foreign('idProducto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_pedido');
    }
};
