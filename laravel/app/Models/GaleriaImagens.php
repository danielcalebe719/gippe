<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriaImagens extends Model
{
    use HasFactory;

    protected $table = 'galeria_imagens'; // Nome da tabela correspondente

    protected $fillable = [
        'evento',
        'descricao',
        'nome_imagem',
        'tamanho_imagem',
        'tipo_imagem',
        'imagemCaminho',
    ];

    // Outros métodos, como relacionamentos ou scopes, podem ser adicionados aqui
}
