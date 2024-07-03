<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clientes;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = 'pedidos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'idClientes', 
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
        return $this->hasOne(Clientes::class,'idClientes','idClientes');
    }

    



}
