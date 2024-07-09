<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnderecosClientes extends Model
{
    use HasFactory;

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

    // public function cliente()
    // {
    //     return $this->hasOne(Clientes::class,'id','idClientes');
    // }
}
