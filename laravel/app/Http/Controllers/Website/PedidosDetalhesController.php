<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\PedidosProdutos;
use App\Models\PedidosServicos;
use App\Models\Agendamentos;
use App\Models\EnderecosClientes;
use App\Models\Servicos;

class PedidosDetalhesController extends Controller
{
    public function index($codigo)
    {
        // Obtendo informações do pedido
        $pedido = Pedidos::where('codigo', $codigo)->firstOrFail();
        
        // Obtendo produtos do pedido
        $produtos = PedidosProdutos::where('idPedidos', $pedido->id)->get();
        
        $subtotal_produtos = 0;
        foreach ($produtos as $produto) {
            $subtotal_produtos += $produto->subtotal; // Ajuste aqui para usar $produto->subtotal
        }
    
        // Obtendo serviços do pedido (se houver)
        $servicos = Servicos::where('id', $pedido->idServicos)->first();
        
        // Obtendo pedidos de serviços do pedido
        $pedidos_servicos = PedidosServicos::where('idServicos', $pedido->idServicos)->get();
        
        // Obtendo agendamento do pedido
        $agendamento = Agendamentos::where('idPedidos', $pedido->id)->first();
        
        // Obtendo endereço do cliente
        $endereco = EnderecosClientes::where('idClientes', $pedido->idClientes)->first();
        
        // Renderizando a visualização com os dados obtidos
        return view('website.pedidosDetalhes', compact('pedido', 'produtos', 'servicos', 'pedidos_servicos', 'agendamento', 'endereco', 'subtotal_produtos'));
    }
    

}
