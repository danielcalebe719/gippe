<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\MovimentacoesProdutos;
use App\Models\PedidosProdutos;
use App\Models\ReceitasItem;
use App\Models\ReceitasItens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
        $produto = Produtos::find($idProdutos);
        
        if ($produto) {

            
            return response()->json($produto);
        } else {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }
    }
    
    
    public function guardar(Request $request)
    {

        try {
            // Busca ou cria um novo cliente
            $produto = $request->idProduto ? Produtos::findOrFail($request->idProduto) : new Produtos();
    
            // Preenche os outros campos do cliente
            $produto->nome = $request->input('nome');
            $produto->descricao = $request->input('descricao');
            $produto->tipo = $request->input('tipo');
            $produto->quantidade = $request->input('quantidade');
            $produto->status = $request->input('status');
            $produto->precoUnitario = $request->input('precoUnitario');
            $produto->caminhoImagem = $request->input('caminhoImagem');

            if(!$request->idProduto){
                $produto->dataCadastro = now();
            }
    
            
  // Trata o upload da imagem, se fornecida
if ($request->hasFile('caminhoImagem')) {
    
    
    // Define o nome do arquivo usando o nome do produto e mantém a extensão original
    $nomeArquivo = $produto->nome . '.' . $request->file('caminhoImagem')->getClientOriginalExtension();
    $path = $request->file('caminhoImagem')->storeAs('public/ImagensProdutos', $nomeArquivo);
    // Deleta a imagem antiga, se existir
    if ($produto->caminhoImagem && Storage::exists('public/ImagensProdutos' . $produto->caminhoImagem)) {
        Storage::delete('public/ImagensProdutos' . $produto->caminhoImagem);
    }
    // Atualiza o campo caminhoImagem com o nome do novo arquivo
    $produto->caminhoImagem = $nomeArquivo;
} else {
    // Mantém o nome do arquivo existente se não houver uma nova imagem enviada
    $nomeArquivo = $produto->caminhoImagem;
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

            // $movimentacoesProdutos = MovimentacoesProdutos::where('idProdutos',$idProduto)->delete();
             $pedidosProdutos = PedidosProdutos::where('idProdutos',$idProduto)->delete();
             $receitasItem = ReceitasItens::where('idProdutos',$idProduto)->delete();
            $produto = Produtos::findOrFail($idProduto);
           
            
            // Excluir a imagem associada, se existir
            if ($produto->caminhoImagem) {
                Storage::delete('public/GaleriaImagens/produtos' . $produto->caminhoImagem);
            }


            $produto->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }       
    }
}
