<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentacoesProdutos extends Model
{
    use HasFactory;

    protected $table = 'moviemntacoes_produtos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'tipo', 
        'idProdutos', 
        'quantidade'.
        'dataCadastro', 
        'dataAtualizacao', 
        'dataRemocao'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    


}


