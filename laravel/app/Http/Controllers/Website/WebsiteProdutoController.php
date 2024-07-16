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
                /*'itens' => 'required|array',
                'itens.*.id' => 'required|integer',
                'itens.*.quantidade' => 'required|integer|min:1',
                'itens.*.precoUnitario' => 'required|numeric|min:0',
                'codigo' => 'required|string'*/
            ]);
        
            try {
                $codigo = $request->codigo;
            
                // Encontre o pedido com base no código
                $pedido = Pedidos::where('codigo', $codigo)->first();
        
                if (!$pedido) {
                    return response()->json(['error' => 'Pedido não encontrado'], 404);
                }
        
                // Verifique se existem produtos associados a este pedido
                $produtosExistentes = PedidosProdutos::where('idPedidos', $pedido->id)->exists();
                $criacao = true;
                if ($produtosExistentes) {
                    // Se existirem produtos, é uma edição. Exclua os produtos existentes.
                    PedidosProdutos::where('idPedidos', $pedido->id)->delete();
                    $criacao = false;
                  
                } else {
                    $criacao = true;
                
                }
        
                // Adicione os novos itens ao pedido
                foreach ($request->itens as $item) {
                    PedidosProdutos::create([
                        'idPedidos' => $pedido->id,
                        'subtotal' => $item['precoUnitario'] * $item['quantidade'],
                        'quantidade' => $item['quantidade'],
                        'idProdutos' => $item['id'],
                        // Adicione outros campos conforme necessário
                    ]);
               
                }
              
        
                // Atualize o total do pedido
                $novoTotal = PedidosProdutos::where('idPedidos', $pedido->id)->sum('subtotal');
                $pedido->totalPedido = $novoTotal;
                $pedido->dataAtualizacao = NOW();
                $pedido->save();
        
                $mensagem = $produtosExistentes ? 'Itens do carrinho atualizados no pedido com sucesso' : 'Itens do carrinho adicionados ao novo pedido com sucesso';
                return response()->json([
                    'message' => $mensagem,
                    'criacao' => $criacao,
                    'codigo' => $pedido->codigo
                ]);
        
            } catch (\Exception $e) {
                // Em caso de erro, capture a exceção e retorne uma resposta de erro
                return response()->json(['error' => 'Erro ao processar o pedido: ' . $e->getMessage()], 500);
            }
        }
    
        public function exibirProdutosSelecionados($codigo)
        {
            $pedido = Pedidos::where('codigo', $codigo)->first();
            if (!$pedido) {
                return redirect()->route('website.produtos')->with('error', 'Pedido não encontrado');
            }
    
            $produtosSelecionados = PedidosProdutos::where('idPedidos', $pedido->id)
                ->join('produtos', 'pedidos_produtos.idProdutos', '=', 'produtos.id')
                ->select('pedidos_produtos.*', 'produtos.nome', 'produtos.caminhoImagem')
                ->get();
    
            $produtos = Produtos::all();
    
            return view('website.produtos', compact('produtos', 'produtosSelecionados', 'pedido'));
        }
    
        // Adicione outros métodos conforme necessário
    }
    

