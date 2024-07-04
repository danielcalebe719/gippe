<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamentos extends Model
{
    use HasFactory;

    protected $table = 'agendamentos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [ 
        'idPedidos',  
        'dataInicio', 
        'dataFim', 
        'horaInicio'.
        'horaFim', 
        'observacao',   
        'dataCadastro'
        
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


   


}


