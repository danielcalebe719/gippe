<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagens extends Model
{
    use HasFactory;

    protected $table = 'mensagens'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'nome', 
        'email', 
        'assunto',
        'mensagem', 
        'dataEnvio'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


   


}


