<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MateriasPrimasEstoque;

class Fornecedores extends Model
{
    use HasFactory;

    protected $table = 'fornecedores'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'nome',
        'telefone1',
        'telefone2',
        'telefone3', 
        'email', 
        'cep'.
        'estado', 
        'cidade', 
        'rua', 
        'numero',
        'complemento',
        'status',
        'dataCadastro',
        'dataAtualizacao',
        'dataRemocao'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;


    public function materiasPrimasEstoque(){
        return $this->hasMany(MateriasPrimasEstoque::class,'idFornecedor', 'id');
    }

    


}


