<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosAndamento extends Model
{
    use HasFactory;

    protected $table = 'pedidos_andamento'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'idPedidos', 
        'data', 
        'status'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;




}


