<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PedidosServicos;

class Servicos extends Model
{
    use HasFactory;

    protected $table = 'servicos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'nome', 
        'totalServicos', 
        'dataCadastro',
        'dataAtualizacao', 
        'dataRemocao', 
        'caminhoImagem', 
        'duracaoHoras',
        'quantidadePessoas'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;

    public function pedidos_servicos()
    {
        return $this->hasMany(PedidosServicos::class, 'idServicos', 'id');
    }
}
