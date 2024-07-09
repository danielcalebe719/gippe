<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosServicosTable extends Migration
{
    public function up()
    {
        Schema::create('pedidos_servicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idServicos');
            $table->unsignedBigInteger('idPedidos');
            $table->enum('funcionarioTipo', ['Garcom', 'Cozinheiro', 'Barman']);
            $table->integer('quantidade');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            $table->foreign('idServicos')->references('id')->on('servicos')->onDelete('cascade');
            $table->foreign('idPedidos')->references('id')->on('pedidos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos_servicos');
    }
}
