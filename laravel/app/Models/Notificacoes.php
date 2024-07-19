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


   

    private static $notificacoesArray = [
        '1'=>'Pedido Criado',
        '2'=>'Pedido Confirmado',
        '3'=>'Pedido Cancelado'
    ];


    

    public function getNotifiacoesArray(){
        return self::$notificacoesArray;
    }

    public function getNotificacao(){
        return self::$notificacoesArray[$this->idNotificacaoArray];
    }



    public function notificacoesClientes()
    {
        return $this->hasMany(NotificacoesClientes::class, 'idNotificacoes');
    }

    public function notificacoesColaboradores()
    {
        return $this->hasMany(NotificacoesColaboradores::class, 'idNotificacoes');
    }

}


