<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecosClientes extends Model
{
    use HasFactory;
   
    protected $table = 'enderecos_clientes'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'tipo', 
        'cep', 
        'cidade'.
        'bairro', 
        'rua', 
        'numero', 
        'complemento',
        'idClientes'
        // Adicione outros campos aqui
    ];

    public $timestamps = false;
}
