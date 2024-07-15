<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PedidosServicos extends Model
{
  use HasFactory;

  protected $table = 'pedidos_servicos';
  protected $primaryKey = 'id';
  protected $fillable =[
    'idServicos',
    'idPedidos',
    'funcionarioTipo',
    'quantidade',
    'subtotal'
  ];
  public $timestamps = false;

  public function servico()
    {
        return $this->belongsTo(Servicos::class, 'idServicos');
    }


    public function pedidosServicos()
    {
        return $this->hasMany(PedidosServicos::class, 'idServicos', 'id');
    }

}
