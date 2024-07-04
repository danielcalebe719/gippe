<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosServicos extends Model
{
    use HasFactory;

    protected $table = 'pedidos_servicos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'idServicos', 
        'idPedidos', 
        'funcionarioTipo'.
        'quantidade', 
        'subtotal'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    


}


