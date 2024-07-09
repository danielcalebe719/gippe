<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\EnderecosClientes;
use App\Models\EsqueciSenha;
use App\Models\NotificacoesClientes;
use App\Models\Pedidos;

class Clientes extends Authenticatable
{
    use HasFactory;

    protected $table = 'clientes'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'nome', 
        'cpf', 
        'dataNascimento', 
        'status', 
        'email', 
        'password',
        'dataCadastro',
        'dataAtualizacao',
        'dataRemocao',
        'caminhoImagem',
        'telefone',
        'last_login'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    public function pedidos(){
        return $this->hasMany(Pedidos::class,'idClientes','id');
    }

    public function enderecos()
    {
        return $this->hasMany(EnderecosClientes::class, 'idClientes');
    }

    public function esqueciSenha(){
        return $this->hasOne(EsqueciSenha::class,'idClientes','id');
    }

    public function notificacoesClientes()
    {
        return $this->hasMany(NotificacoesClientes::class,'idClientes','id');
    }

}

