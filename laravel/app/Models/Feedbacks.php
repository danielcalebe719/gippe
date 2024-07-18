<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedidos;

class Feedbacks extends Model
{
    use HasFactory;

    protected $table = 'feedbacks'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'mensagem', 
        'avaliacao', 
        'dataMensagem',
        'idPedidos',
        'idClientes',
        // Adicione outros campos aqui
    ];
    public $timestamps = false;

    public function produto()
    {
        return $this->belongsTo(Pedidos::class, 'idPedidos');
    }
    
    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'idPedidos');
    }

}


