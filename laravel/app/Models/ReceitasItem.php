<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceitasItem extends Model
{
    use HasFactory;

    protected $table = 'receitas_item'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'idProdutos', 
        'idMateriasPrimas', 
        'quantidade'.
        'subtotal'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    


}


