<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    use HasFactory;

    protected $table = 'gastos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id'; // Nome da chave primária
    protected $fillable = [   
        'motivo', 
        'valor', 
        'dataCadastro',
        'dataAtualizacao',
        'departamento',
        'status'
        // Adicione outros campos aqui
    ];
    public $timestamps = false;

    private static $statusArray = [
        null => '',
        '1' => 'Pendente',
        '2' => 'Pago'
        
    ];
    public static function getStatusArray(){
        return self::$statusArray;
    }

    public function getStatus(){
        return self::$statusArray[$this->status];
    }
  


}


