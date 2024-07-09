<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriaImagens extends Model
{
    use HasFactory;

    protected $table = 'galeria_imagens'; // Nome da tabela correspondente
    protected $primaryKey = 'id';
    protected $fillable = [
        'evento',
        'descricao',
        'nomeImagem',
        'tamanhoImagem',
        'tipoImagem',
        'caminhoImagem'
    ];
    public $timestamps = false;
    // Outros métodos, como relacionamentos ou scopes, podem ser adicionados aqui
}
