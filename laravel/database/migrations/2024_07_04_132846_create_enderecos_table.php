<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosClientesTable extends Migration
{
    public function up()
    {
        Schema::create('enderecos_clientes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['residencial', 'comercial'])->nullable();
            $table->integer('cep')->nullable();
            $table->string('cidade', 255)->nullable();
            $table->string('bairro', 255)->nullable();
            $table->string('rua', 255)->nullable();
            $table->integer('numero')->nullable();
            $table->string('complemento', 255)->nullable();
            $table->unsignedBigInteger('idClientes')->nullable();
            $table->foreign('idClientes')->references('idClientes')->on('clientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enderecos_clientes');
    }
}
