<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedidos; 
use App\Models\Servicos; 
use App\Models\Produtos;// Importe o modelo Produto se ainda não estiver importado
use App\Models\PedidosProdutos;
use App\Models\PedidosServicos;

class WebsiteProdutoController extends Controller
{
     
    public function index(Request $request, $codigo)
    {
        // Busca o pedido pelo código
        $pedido = Pedidos::where('codigo', $codigo)->first();
    
        if (!$pedido) {
            // Lida com o caso em que o pedido não é encontrado
            return redirect()->route('alguma.rota')->with('error', 'Pedido não encontrado.');
        }
    
        // Recupera os produtos selecionados para o pedido
        $produtosSelecionados = PedidosProdutos::where('idPedidos', $pedido->id)
        ->join('produtos', 'pedidos_produtos.idProdutos', '=', 'produtos.id')
        ->select('produtos.id as produto_id', 'produtos.nome', 'produtos.descricao', 'produtos.precoUnitario', 'produtos.caminhoImagem', 'pedidos_produtos.quantidade')
        ->get();
    
        
    
        
        $idPedido = $pedido->id;
        $idServico = $pedido->idServicos;
    
        // Busca o serviço relacionado ao pedido
        $servico = Servicos::where('id', $idServico)->first();
        
        // Recupera os serviços associados ao pedido
        $pedidos_servicos = PedidosServicos::where('idServicos', $idServico)->get();
    
        // Calcula o subtotal dos produtos selecionados
        $subtotal = $produtosSelecionados->sum(function ($prod) {
            return $prod->precoUnitario * $prod->quantidade;
        });
    
        // Recupera todos os produtos do banco de dados
        $produto = Produtos::all();
    
        return view('website.produtos', [
            'produtos' => $produto,
            'codigo' => $codigo,
            'pedido' => $pedido,
            'servico' => $servico,
            'pedidos_servicos' => $pedidos_servicos,
            'produtosSelecionados' => $produtosSelecionados,
            'subtotal' => $subtotal,
        ]);
    }
    
    
    
    

    public function adicionarAoPedido(Request $request)
    {
        // Valide os dados recebidos
        $request->validate([
           /* 'itens' => 'required|array', // Verifica se 'itens' é um array
            'itens.*.id' => 'required|integer', // Verifica se cada item tem um ID válido
            'itens.*.quantidade' => 'required|integer|min:1', // Verifica se a quantidade é válida
            'itens.*.precoUnitario' => 'required|numeric|min:0', // Verifica se o preço unitário é válido*/
        ]);
        
    
        try {
            $codigo = $request->codigo;
    
            // Encontre o pedido com base no código
            $pedido = Pedidos::where('codigo', $codigo)->first();
        
    
            if (!$pedido) {
                return response()->json(['error' => 'Pedido não encontrado'], 404);
            }
    
            // Percorra os itens do carrinho e insira na tabela pedidos_produtos
            foreach ($request->itens as $item) {
                PedidosProdutos::create([
                    'idPedidos' => $pedido->id,
                    'subtotal' => $item['precoUnitario'] * $item['quantidade'],
                    'quantidade' => $item['quantidade'],
                    'idProdutos' => $item['id'],
                    // Adicione outros campos conforme necessário
                ]);
            }
    
            // Retorne uma resposta adequada, como sucesso ou erro
            return response()->json(['message' => 'Itens do carrinho adicionados ao pedido com sucesso']);
    
        } catch (\Exception $e) {
            // Em caso de erro, capture a exceção e retorne uma resposta de erro
            return response()->json(['error' => 'Erro ao adicionar itens ao pedido: ' . $e->getMessage()], 500);
        }
    }
    


    public function carregarMaisProdutos(Request $request)
{
  
    $skip = $request->query('skip', 0);
    $produtos = Produtos::skip($skip)->take(5)->get();
    
    return view('partials.produtos', compact('produtos'));
}
    
}
