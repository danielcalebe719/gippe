<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentacoesMateriasPrimas extends Model
{
    use HasFactory;

    protected $table = 'movimentacois_materias_primas'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'idMateriaPrima', 
        'tipo', 
        'quantidade'.
        'dataCadastro', 
        'dataAtualizacao', 
        'dataRemocao'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    

}


