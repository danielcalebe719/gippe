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


    private static $statusArray = [
        null => '',
        '1' => 'Não finalizado',
        '2' => 'Em Análise',
        '3' => 'Aceito',
        '4' => 'Em produção',
        '5' => 'Produzido',
        '6' => 'Entregue',
        '7' => 'Recusado',
        '8' => 'Cancelado'
    ];
    public static function getStatusArray(){
        return self::$statusArray;
    }

    public function getStatus(){
        return self::$statusArray[$this->status];
    }


    public function pedidosProdutos()
    {
        return $this->hasMany(PedidosProdutos::class, 'idPedidos');
    }
    public function pedidosServicos()
    {
        return $this->hasMany(PedidosServicos::class, 'idPedidos', 'id'); // ajuste os nomes conforme sua estrutura
    }

    // Relacionamento com Produtos através de PedidosProdutos
    // public function produtos()
    // {
    //     return $this->hasManyThrough(
    //         Produtos::class,
    //         PedidosProdutos::class,
    //         'idPedidos', // Chave estrangeira na tabela PedidosProdutos
    //         'id', // Chave estrangeira na tabela Produtos
    //         'id', // Chave local na tabela Pedidos
    //         'idProdutos' // Chave local na tabela PedidosProdutos
    //     );
    // }

    public function cliente()
    {
        return $this->hasOne(Clientes::class,'id','idClientes');
    }

    public function servico(){
        return $this->hasOne(Servicos::class,'id','idServicos');
    }

    public function feedback()
    {
        return $this->hasOne(Feedbacks::class,'id', 'idPedidos' );
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

    // public function pedidosProdutos()
    // {
    //     return $this->hasMany(PedidosProdutos::class,'idPedidos','id');
    // }


       public function pedidos_servicos()
     {
         return $this->hasMany(PedidosServicos::class,'idPedidos','id');
     }

    
    public function agendamento()
    {
        return $this->hasOne(Agendamentos::class, 'idPedidos', 'id');
    }

}
