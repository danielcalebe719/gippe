<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    use HasFactory;

    protected $table = 'gastos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'motivo', 
        'valor', 
        'dataCadastro',
        'dataAtualizacao'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


  


}


