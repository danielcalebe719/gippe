<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

   
  
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
