<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'idPedidos'; // Nome da chave primária
    protected $fillable = [   
        'idCliente', 
        'observacao', 
        'status', 
        'totalPedido', 
        'dataPedido', 
        'dataEntrega',
        'dataAtualizacao'
        
        // Adicione outros campos aqui
    ];
    public $timestamps = false;
}
