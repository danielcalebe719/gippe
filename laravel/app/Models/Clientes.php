<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Clientes extends Authenticatable
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
        'password',
        'dataCadastro',
        'dataAtualizacao',
        'dataRemocao',
        'imgCaminho'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    public function pedidos(){
        return $this->hasMany(Pedidos::class,'idClientes','id');
    }


}

