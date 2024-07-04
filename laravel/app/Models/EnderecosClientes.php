<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecosClientes extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======
   
    protected $table = 'enderecos_clientes'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'tipo', 
        'cep', 
        'cidade'.
        'bairro', 
        'rua', 
        'numero', 
        'complemento',
        'idClientes'
        // Adicione outros campos aqui
    ];
>>>>>>> b8e57919c74e1ee132d9858b21fd27e26288399a

    protected $table = 'enderecos_clientes';

    protected $fillable = [
        'tipo', // Add 'tipo' here to allow mass assignment
        'cep',
        'cidade',
        'bairro',
        'rua',
        'numero',
        'complemento',
        'idClientes',
    ];
    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'idClientes');
    }
}
