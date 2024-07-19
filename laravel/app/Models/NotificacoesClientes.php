<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacoesClientes extends Model
{
    use HasFactory;
   protected $table = 'notificacoes_clientes';
   protected $primaryKey = 'id';
   protected $fillable = [
    'idPedidos',
    'idClientes',
    'idNotificacoes'
   ];

    public $timestamps = false;

    public function notificacao()
    {
        return $this->belongsTo(Notificacoes::class, 'idNotificacoes');
    }

}
