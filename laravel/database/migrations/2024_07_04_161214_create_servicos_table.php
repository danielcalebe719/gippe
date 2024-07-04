<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosTable extends Migration
{
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->enum('nomeServico', ['festa pequena', 'festa media', 'festa grande'])->nullable();
            $table->decimal('total_servicos', 10, 2)->nullable();
            $table->date('dataCadastro')->default(now());
            $table->date('dataAtualizacao')->default(now());
            $table->date('dataRemocao')->nullable();
            $table->varchar('imgCaminho', 200)->nullable();
            $table->integer('duracaoHoras')->nullable();
            $table->integer('quantidadePessoas')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('servicos');
    }
}
