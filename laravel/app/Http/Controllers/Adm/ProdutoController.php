<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\MovimentacoesProdutos;
use App\Models\PedidosProdutos;
use App\Models\ReceitasItem;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produtos::all();
        return view('adm.produtos', compact('produtos'));
    }

    public function show($idProdutos)
    {
        $produto = Clientes::find($idProdutos);
        
        if ($produto) {

            
            return response()->json($produto);
        } else {
            return response()->json(['error' => 'Produto não encontrado'], 404);
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
            $produto = $request->idProduto ? Produto::findOrFail($request->idProduto) : new Produtos();
    
            // Preenche os outros campos do cliente
            $produto->nome = $request->input('nome');
            $produto->descricao = $request->input('descricao');
            $produto->tipo = $request->input('tipo');
            $produto->quantidade = $request->input('quantidade');
            $produto->status = $request->input('status');
            $produto->precoUnitario = $request->input('precoUnitario');
            $produto->caminhoImagem = $request->input('caminhoImagem');

            if(!$request->idPedido){
                $pedido->dataPedido = now();
            }
    
            // Verifica se foi fornecida uma nova senha
            if ($request->filled('senha')) {
                $produto->senha = Hash::make($request->input('senha'));
            }
    
            // Trata o upload da imagem, se fornecida
            if ($request->hasFile('caminhoImagem')) {
                // Deleta a imagem antiga, se existir
                if ($produto->caminhoImagem && Storage::exists('public/GaleriaImagens/' . $produto->caminhoImagem)) {
                    Storage::delete('public/GaleriaImagens/' . $produto->caminhoImagem);
                }
                
                // Armazena a nova imagem
                $path = $request->file('caminhoImagem')->store('public/GaleriaImagens');
                $produto->caminhoImagem = basename($path);
            }
    
            // Atualiza o timestamp de atualização
            $produto->dataAtualizacao = now();  
    
            // Salva o produto
            $produto->save();
            
            return redirect()->back()->with('success', 'Cliente adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }
    
    
    











    
    public function remover($idProduto)
    {
        try {

            $movimentacoesProdutos = MovimentacoesProdutos::where('idProdutos',$idProduto)->delete();
            $pedidosProdutos = PedidosProdutos::where('idProdutos',$idProduto)->delete();
            $receitasItem = ReceitasItem::where('idProdutos',$idProduto)->delete();
            $produto = Produtos::findOrFail($idProduto);
           
            
            // Excluir a imagem associada, se existir
            if ($produto->caminhoImagem) {
                Storage::delete('public/GaleriaImagens/' . $produto->caminhoImagem);
            }


            $produto->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }       
    }
}
