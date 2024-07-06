<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\EnderecosClientes;
use App\Models\NotificacoesClientes;
use App\Models\Pedidos;
use App\Models\ReceitasItens;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class ReceitaItemController extends Controller
{
    public function index()
    {
        $receitasItens = ReceitasItens::all();
        return view('adm.receitasItens', compact('receitasItens'));
    }

    public function show($idReceitasItens)
    {
        $receitaItem = ReceitasItens::find($idReceitasItens);
        
        if ($receitaItem) {

            
            return response()->json($receitaItem);
        } else {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        }
    }
    
    
    public function guardar(Request $request)
    {
        // Validação dos dados
        /*$request->validate([
            'nome' => 'nullable|string|max:255',
            'cpf' => 'nullable|string|max:14|unique:clientes,cpf,' . $request->idCliente . ',idClientes',
            'dataNascimento' => 'nullable|date',
            'status' => 'nullable|string|in:ativo,inativo',
            'email' => 'nullable|email|max:255|unique:clientes,email,' . $request->idCliente . ',idClientes',
            'senha' => 'nullable|string|min:6',
            'telefone' => 'nullable|string|max:20',
            // 'imgCaminho' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);*/   
    
        try {
            // Busca ou cria um novo cliente
            $receitaItem = $request->idReceitaItem ? ReceitasItens::findOrFail($request->idReceitaItem) : new ReceitasItens();
    
            // Preenche os outros campos do cliente
            $receitaItem->idProdutos = $request->input('idProdutos');
            $receitaItem->idMateriasPrimas = $request->input('idMateriasPrimas');
            $receitaItem->quantidade = $request->input('quantidade');
            $receitaItem->subtotal = $request->input('subtotal');
            
    
            
    
            // Salva o cliente
            $receitaItem->save();
            
            return redirect()->back()->with('success', 'Cliente adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }
    
    
    











    
    public function remover($idReceitasItem)
    {
        try {

            
            $receitaItem = ReceitasItens::findOrFail($idReceitasItem);
           
            
            


            $receitaItem->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }       
    }
}
