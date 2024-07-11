<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MovimentacoesProdutos;
use App\Models\PedidosProdutos;
use App\Models\ReceitasItem;

class Produtos extends Model
{
    use HasFactory;

    protected $table = 'produtos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'nome', 
        'descricao', 
        'tipo',
        'quantidade', 
        'status', 
        'precoUnitario', 
        'dataCadastro',
        'dataAtualizacao',
        'dataRemocao',
        'caminhoImagem'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;

    // Relacionamento com PedidosProdutos
    public function pedidosProdutos()
    {
        return $this->hasMany(PedidosProdutos::class, 'idProdutos', 'id');
    }

    public function movimentacoesProdutos(){
        return $this->hasOne(MovimentacoesProdutos::class,'idProdutos','id');
    }

    // public function pedidosProdutos()
    // {
    //     return $this->hasMany(PedidosProdutos::class,'idProdutos','id');
    // }

    // public function receitasItem()
    // {
    //     return $this->hasMany(ReceitasItem::class,'idProdutos','id');
    // }

}


