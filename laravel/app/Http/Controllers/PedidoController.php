<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Carbon;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        return view('adm.pedidos', compact('pedidos'));
    }

    public function show($idPedidos)
    {
        $pedido = Pedido::find($idPedidos);
        if ($pedido) {
            return response()->json($pedido);
        } else {
            return response()->json(['error' => 'Pedido não encontrado'], 404);
        }
    }

    public function update(Request $request, $idPedidos)
    {
        // Validação dos dados
        $request->validate([
            'idCLiente' => 'required|exists:clientes,idCLientes',
            'observacao' => 'required|sring|max:500',
            'status' => 'required|string|in:Pendente, Aceito, Cancelado, Entregue',
            'totalPedido' => 'required|numeric|between:0,999999999.99',
            'dataEntrega' => 'required|date'
            
            
            // Adicione outras regras de validação conforme necessário
        ]);

        try {
            // Buscar o cliente pelo idClientes
            $pedido = Pedido::findOrFail($idPedidos);

            // Atribuir os novos valores ao pedido
            $pedido->idCLiente = $request->input('idCliente');
            $pedido->observacao = $request->input('observacao');
            $pedido->status = $request->input('status');
            $pedido->totalPedido = $request->input('totalPedido');
            $pedido->dataEntrega = $request->input('dataEntrega');

            // Salvar as alterações
            $pedido->dataAtualizacao = Carbon::now();
            $pedido->save();

            return response()->json(['message' => 'Pedido atualizado com sucesso']);
        } catch (\Exception $e) {
            // Capturar e tratar exceções, se necessário
            return response()->json(['error' => 'Erro ao atualizar o pedido: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'idCLiente' => 'required|exists:clientes,idCLientes',
            'observacao' => 'required|sring|max:500',
            'status' => 'required|string|in:Pendente, Aceito, Cancelado, Entregue',
            'totalPedido' => 'required|numeric|between:0,999999999.99',
            'dataEntrega' => 'required|date'
        ]);

        

        // Criação do pedido no banco de dados
        $pedido = new Pedido();
        $pedido->idCliente = $request->idCliente;
        $pedido->observacao = $request->observacao;
        $pedido->status = $request->status;
        $pedido->totalPedido = $request->totalPedido;
        $pedido->dataEntrega = $request->dataEntrega;
        $dataAtual = Carbon::now();
        $pedido->dataPedido = $dataAtual;
        $pedido->dataAtualizacao = $dataAtual;

        $pedido->save();

        // Redirecionamento ou resposta de sucesso
        return redirect()->back()->with('success', 'Pedido adicionado com sucesso!');
    }

    
    public function destroy($idPedidos)
    {
        try {
            $pedido = Pedido::findOrFail($idPedidos);
            $pedido->delete();
    
            return response()->json(['message' => 'Pedido excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o pedido: ' . $e->getMessage()], 500);
        }
    }
    

}


