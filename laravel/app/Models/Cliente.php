<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes'; // Nome da tabela no banco de dados
    protected $primaryKey = 'idClientes'; // Nome da chave primária
    protected $fillable = [   
        'nome', 
        'cpf', 
        'data_de_nascimento', 
        'status', 
        'email', 
        'senha',
        'dataCadastro',
        'dataAtualizacao',
        'dataRemocao',
        'imgCaminho',
        'telefone'
        // Adicione outros campos aqui
    ];
}
