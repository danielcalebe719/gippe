<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriaImagensTable extends Migration
{
    public function up()
    {
        Schema::create('galeria_imagens', function (Blueprint $table) {
            $table->id();
            $table->enum('evento', ['outros', 'casamento', '15anos', 'formatura'])->default('outros');
            $table->string('descricao', 255);
            $table->string('nome_imagem', 25);
            $table->string('tamanho_imagem', 25);
            $table->string('tipo_imagem', 25);
            $table->string('imagemCaminho', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('galeria_imagens');
    }
}
