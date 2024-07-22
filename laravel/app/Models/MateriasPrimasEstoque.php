<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MovimentacoesMateriasPrimas;
use App\Models\ReceitasItem;

class MateriasPrimasEstoque extends Model
{
    use HasFactory;

    protected $table = 'materias_primas_estoque'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'nome', 
        'classificacao', 
        'quantidade',
        'precoUnitario', 
        'dataCadastro', 
        'dataAtualizacao', 
        'dataRemocao',
        'caminhoImagem',
        'idFornecedores'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    public function movimentacoesMateriasPrimas(){
        return $this->hasOne(MovimentacoesMateriasPrimas::class,'idMateriaPrima','id');
    }

    public function fornecedor(){
        return $this->hasOne(Fornecedores::class,'id','idFornecedores');
    }

    // public function receitasItem()
    // {
    //     return $this->hasMany(ReceitasItem::class,'idMateriasPrimas','id');
    // }


}


