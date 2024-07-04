<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EsqueciSenha extends Model
{
    use HasFactory;

    protected $table = 'esqueci_senha'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'idClientes', 
        'token', 
        'dataEmissao'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    

}


