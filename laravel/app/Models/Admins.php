<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\AdmPermissoes;
use App\Models\NotificacoesColaboradores;


class Admins extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'email', 
        'password', 
        'nome',
        'last_login',
        'permissoes'
        // Adicione outros campos aqui
    ];
    protected $casts = [
        'last_login' => 'datetime',
    ];
    public $timestamps = false;

    public function admPermissoes()
    {
        return $this->hasOne(AdmPermissoes::class,'idAdmins','id');
    }

    public function notificacoesColaboradores()
    {
        return $this->hasMany(NotificacoesColaboradores::class,'idAdmins','id');
    }

}



