<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clientes;
use App\Models\Agendamentos;
use App\Models\Feedbacks;
use App\Models\NotificacoesClientes;
use App\Models\NotificacoesColaboradores;
use App\Models\PedidosAndamento;
use App\Models\PedidosProdutos;
use App\Models\PedidosServicos;
use Illuminate\Support\Str;

class Pedidos extends Model
{
    use HasFactory;

    //protected $table = 'pedidos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária

   

    protected $fillable = [
        'idServicos',    
        'idClientes', 
        'codigo',
        'observacao', 
        'status',   
        'totalPedido', 
        'dataPedido', 
        'dataEntrega',
        'dataAtualizacao'
        
        // Adicione outros campos aqui
    ];
  
    public $timestamps = false;


    public function cliente()
    {
        return $this->hasOne(Clientes::class,'id','id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedbacks::class,'idPedidos','id');
    }

    public function notificacoesClientes()
    {
        return $this->hasMany(NotificacoesClientes::class,'idPedidos','id');
    }

    public function notificacoesColaboradores()
    {
        return $this->hasMany(NotificacoesColaboradores::class,'idPedidos','id');
    }

    public function pedidosAndamento()
    {
        return $this->hasMany(PedidosAndamento::class,'idPedidos','id');
    }

    public function pedidosProdutos()
    {
        return $this->hasMany(PedidosProdutos::class,'idPedidos','id');
    }

    public function pedidosServicos()
    {
        return $this->hasOne(PedidosServicos::class,'idPedidos','id');
    }
    public function agendamentos()
    {
        return $this->hasOne(Agendamentos::class,'idPedidos','id');
    }

}
