<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NotificacoesClientes;
use App\Models\NotificacoesColaboradores;

class Notificacoes extends Model
{
    use HasFactory;

    protected $table = 'notificacoes'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'mensagem', 
        'dataEnvio', 
        'titulo'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;

    public function notificacoesClientes()
    {
        return $this->hasMany(NotificacoesClientes::class,'idNotificacoes','id');
    }

    public function notificacoesColaboradores()
    {
        return $this->hasMany(NotificacoesColaboradores::class,'idNotificacoes','id');
    }

}


