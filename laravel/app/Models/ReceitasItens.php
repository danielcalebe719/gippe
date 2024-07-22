<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceitasItens extends Model
{
    use HasFactory;

    protected $table = 'receitas_itens'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'idProdutos', 
        'idMateriasPrimas', 
        'quantidade',
        'subtotal'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;

    public function produto()
    {
        return $this->hasOne(Produtos::class,'id','idProdutos');
    }
    public function materiaPrima()
    {
        return $this->hasOne(MateriasPrimasEstoque::class,'id','idMateriasPrimas');
    }
    


}


