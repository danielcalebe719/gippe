<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admins extends Authenticatable
{
    use HasFactory;

    protected $fillable = [   
        'nome', 
        'email', 
        'password',
        // Adicione outros campos aqui
    ];
    public $timestamps = false;




}



