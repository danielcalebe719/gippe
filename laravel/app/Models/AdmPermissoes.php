<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AdmPermissoes extends Model
{
    use HasFactory;

    protected $table = 'admpermissoes'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'cargo', 
        'permissoes', 
        'dataCadastro',
        'dataAtualizacao',
        'dataRemocao',
        'idAdmins'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    


}


