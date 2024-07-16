<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\Feedbacks;
use App\Models\Clientes;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    // public function index()
    // {
    //     $pedidos = Pedidos::all();
    //     return view('adm.pedidos', compact('pedidos'));
    // }

    public function index()
{
    $pedidosPendentes = Pedidos::where('status', '2')->get();
    $outrosPedidos = Pedidos::where('status', '!=', '2')->get();
    
    return view('adm.pedidos', compact('pedidosPendentes', 'outrosPedidos'));
}

    public function show($idPedidos)
    {
        $pedido = Pedidos::with([
            'pedidosProdutos.produto',
            'pedidosServicos.servico',
            'agendamento'
        ])->find($idPedidos);
    
        if ($pedido) {
            return response()->json($pedido);
        } else {
            return response()->json(['error' => 'Pedido não encontrado'], 404);
        }
    }

    public function showFeedback($idPedidos)
    {
        $feedbacks = Feedbacks::where('idPedidos',$idPedidos) -> get();
        
        
        if ($feedbacks->isNotEmpty()) {

            
            return response()->json($feedbacks);
        } else {
            return response()->json(['error' => 'feedback não encontrado'], 404);
        }
    }

    public function guardar(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'idCLientes' => 'required',
        //     'observacao' => 'required|max : 500',
        //     'status' => 'required|in:Pendente, Aceito, Cancelado, Entregue',
        //     'totalPedido' => 'required',
        //     'dataEntrega' => 'required'
        // ]);
 
        // if ($validator->fails()) {
	    //     return $validator->errors()->all();
        // }
        // Validação dos dados
        // $request->validate([
        //     'idCLientes' => 'required',
        //     'observacao' => 'required|max : 500',
        //     'status' => 'required|in:Pendente, Aceito, Cancelado, Entregue',
        //     'totalPedido' => 'required',
        //     'dataEntrega' => 'required'
        // ]);  
    
        try {
            // Busca ou cria um novo cliente
            $pedido = $request->idPedido ? Pedidos::findOrFail($request->idPedido) : new Pedidos();
    
            // Preenche os outros campos do cliente
            $pedido->idClientes = $request->input('idCliente');
            $pedido->idServicos = $request->input('idServico');
            $pedido->observacao = $request->input('observacao');
            $pedido->status = $request->input('status');
            $pedido->totalPedido = $request->input('totalPedido');
            $pedido->dataEntrega = $request->input('dataEntrega');

            if(!$request->idPedido){
                $pedido->dataPedido = now();
            }
            
    
    
            // Atualiza o timestamp de atualização
            $pedido->dataAtualizacao = now();  
    
            // Salva o pedido
            $pedido->save();
            
            return redirect()->back()->with('success', 'Pedido adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o pedido: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o pedido: ' . $e->getMessage()], 500);
        }
    }

    public function aceitar($idPedidos){
        try{
            $pedido = Pedidos::findOrFail($idPedidos);
            $pedido->status = 3;
            $pedido->save();
            return response()->json(['message' => 'Pedido aceito com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao aceitar o pedido: ' . $e->getMessage()], 500);
        }
       
    }

    public function remover($idPedidos)
    {
        try {
            $pedido = Pedidos::findOrFail($idPedidos);
            $pedido->delete();
    
            return response()->json(['message' => 'Pedido excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o pedido: ' . $e->getMessage()], 500);
        }
    }
    

}


