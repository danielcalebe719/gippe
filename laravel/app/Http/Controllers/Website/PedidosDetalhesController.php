<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\EnderecosClientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class PedidosDetalhesController extends Controller

{
    
    public function index()
    {
        return view('website.pedidosDetalhes');
    }

  
}    
