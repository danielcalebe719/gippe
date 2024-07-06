<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agendamentos;
use App\Models\Pedidos;
use App\Models\Clientes;
use App\Models\EnderecosClientes;
use Illuminate\Support\Facades\Auth;


class WebsitePerfilController extends Controller
{
   
     
        public function index()
{
    if (Auth::guard('cliente')->check()) {
        $idCliente = Auth::guard('cliente')->user()->id;
        
        // Recupera o cliente
        $clientes = Clientes::where('id', $idCliente)->first();
        
        // Recupera todos os pedidos do cliente
        $pedidos = Pedidos::where('idClientes', $idCliente)->get();
        
        // Recupera o endereço do cliente
        $enderecos_clientes = EnderecosClientes::where('idClientes', $idCliente)->first();
        
        
        return view('website.perfil', compact('clientes', 'pedidos', 'enderecos_clientes'));
    }
    
    return redirect()->route('outra.rota');
}

    
    


public function salvar(Request $request)
{
   
}


}
