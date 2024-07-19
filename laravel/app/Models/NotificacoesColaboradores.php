<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacoesColaboradores extends Model
{
    use HasFactory;

    protected $table = 'notificacoes_colaboradores'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'idPedidos', 
        'idAdmins', 
        'idNotificacoes'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;

    public function notificacao()
    {
        return $this->belongsTo(Notificacoes::class, 'idNotificacoes');
    }

    


}


