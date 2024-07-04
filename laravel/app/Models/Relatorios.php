<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatorios extends Model
{
    use HasFactory;

    protected $table = 'relatorios'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'parametros', 
        'dataEmissao'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


   


}


