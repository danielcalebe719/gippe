<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = 'clientes'; // Nome da tabela no banco de dados
    protected $primaryKey = 'idClientes'; // Nome da chave primária
    protected $fillable = [   
        'nome', 
        'cpf', 
        'telefone'.
        'data_de_nascimento', 
        'status', 
        'email', 
        'senha',
        'dataCadastro',
        'dataAtualizacao',
        'dataRemocao',
        'imgCaminho'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    public function pedidos(){
        return $this->hasMany(Pedido::class,'idClientes','id');
    }


}


