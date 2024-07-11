<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosProdutos extends Model
{
    use HasFactory;

    protected $table = 'pedidos_produtos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'idPedidos', 
        'idProdutos', 
        'quantidade',
        'subtotal'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    // Relacionamento com Produtos
    public function produto()
    {
        return $this->belongsTo(Produtos::class, 'idProdutos');
    }

    // Relacionamento com Pedidos
    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'idPedidos', 'id');
    }


}


