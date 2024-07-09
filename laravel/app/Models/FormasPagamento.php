<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormasPagamento extends Model
{
    use HasFactory;

    protected $table = 'formas_pagamento'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'nome', 
        'classe'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    

}


