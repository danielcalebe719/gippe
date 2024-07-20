<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Servicos;
use App\Models\NotificacoesClientes;
use App\Models\Notificacoes;
use Illuminate\Http\Request;
use App\Models\PpServicos;
use Illuminate\Support\Facades\DB;
use App\Models\Pedidos;
use App\Models\Clientes;
use App\Models\PedidosServicos;
use Illuminate\Support\Str;

class WebsiteServicoController extends Controller
{
    public function index(Request $request, $codigo = null,)
    {

        $pedidos = null;
    
        if ($codigo) {
            $pedidos = Pedidos::with('pedidos_servicos')
                              ->where('codigo', $codigo)
                              ->first();
        }
    
        $servicos = Servicos::with('pedidos_servicos')
                            ->orderBy('id', 'asc')
                            ->limit(4)
                            ->get();
    
        return view('website.servicos', compact('servicos', 'pedidos'));
    }
    

        public function salvar_padrao(Request $request)
        {
            $pedido = Pedidos::find($request->idPedidos);
            
            if (!$pedido) {
                // Se o pedido não existir, crie um novo
                $pedido = new Pedidos();
                $pedido->idServicos = $request->idServicos;
                $pedido->idClientes = $request->idClientes;
                $pedido->idEnderecos = $request->idEnderecos;
                $pedido->dataAtualizacao = NOW();
                $pedido->status = 1;
               
                $criacao = true;
                do {
                    $codigo = 'PE' . Str::random(6) . mt_rand(10, 99);
                } while (Pedidos::where('codigo', $codigo)->exists());
                
                $pedido->codigo = $codigo;
              
                $pedido->dataPedido = now();
            } else {
                // Se o pedido existir, atualize os campos necessários
                $pedido->idServicos = $request->idServicos;
                $pedido->idClientes = $request->idClientes;
                $pedido->idEnderecos = $request->idEnderecos;
                $pedido->dataAtualizacao = NOW();
                $pedido->status = 2;
                $pedido->dataPedido = now();
                $criacao = false;
            }
            
            $pedido->save();

            
            $cliente = Clientes::find($request->idClientes);
            $notificacao = Notificacoes::create([
                 'titulo' => 'Novo pedido',
                 'mensagem' => 'Olá ' .$cliente->nome.'! Novo pedido criado: #' . $pedido->codigo .
                 ' fique atento as notificações 
                 e acompanhe seu pedido!',
                 'dataEnvio' => NOW(),
                 // Outros campos da notificação, se houverem
             ]);
             NotificacoesClientes::create([
                 'idPedidos' => $pedido->id,
                 'idClientes' => $request->idClientes,
                'idNotificacoes' => $notificacao->id,
                 // Outros campos da notificação, se houverem
             ]); 
     
            
            $totalServicos = DB::table('servicos')
                ->where('id', $pedido->idServicos)
                ->value('totalServicos');
            
            // Atualização do totalPedido na tabela pedidos
            DB::table('pedidos')
                ->where('id', $pedido->id)
                ->update(['totalPedido' => $totalServicos]);


            if(!$criacao){
                
                return redirect()->route('pedidosDetalhes.index', ['codigo' => $pedido->codigo])
                ->with('success', 'Serviço Selecionado com sucesso.');
            }else{

            return redirect()->route('website.produtos', ['codigo' => $pedido->codigo])
                ->with('success', 'Serviço Selecionado com sucesso.');}
        }
        

    

            public function salvar_personalizado(Request $request)
            {
                // Validação dos dados do formulário
                $request->validate([
                    'duracaoHoras' => 'required|integer|min:1|max:24',
                    'quantidadePessoas' => 'required|integer|min:0|max:999',
                    'idClientes' => 'required|integer',
                    'tipo' => 'required|array',
                ]);
            
                // Criação do serviço
                $servico = new Servicos();
                $servico->nome = 'Personalizado'; 
                $servico->dataCadastro = now(); 
                $servico->dataRemocao = null; 
                $servico->caminhoImagem = null; 
                $servico->duracaoHoras = $request->duracaoHoras;
                $servico->quantidadePessoas = $request->quantidadePessoas;
                $servico->save();
            
                // Verificação se está editando um pedido existente
                $pedido = Pedidos::find($request->id);
            
                if (!$pedido) {
                    // Se não existe pedido, cria um novo
                    $pedido = new Pedidos();
                    $pedido->idServicos = $servico->id;
                    $pedido->idClientes = $request->idClientes;
                    $pedido->status = 1;
                    $criacao = true;
                    do {
                        $codigo = 'PE' . Str::random(6) . mt_rand(10, 99);
                    } while (Pedidos::where('codigo', $codigo)->exists());
            
                    $pedido->codigo = $codigo;
                    $pedido->dataPedido = now();  
                } else {
                    // Atualiza o pedido existente
                    $pedido->idClientes = $request->idClientes;
                    $pedido->idServicos = $servico->id; // Atualiza o serviço associado
                    $pedido->status = 2;
                    $pedido->dataPedido = now();
                    $criacao = false;   
                }
            
                $pedido->totalPedido = $servico->totalServicos;
              
                $pedido->save();
            
                // Atualização ou criação dos pedidos de serviço associados
                foreach ($request->tipo as $chave => $valor) {
                    PedidosServicos::updateOrCreate(
                        [
                            'idServicos' => $servico->id,
                            'funcionarioTipo' => $chave,
                        ],
                        [
                            'quantidade' => $valor,
                            'subtotal' => $valor * 150 // conforme a lógica depois
                        ]
                    );
                }
            
                // Atualização do totalPedido na tabela pedidos
                $totalServicos = DB::table('servicos')
                    ->where('id', $pedido->idServicos)
                    ->value('totalServicos');
            
                DB::table('pedidos')
                    ->where('id', $pedido->id)
                    ->update(['totalPedido' => $totalServicos]);
            
                    $cliente = Clientes::find($request->idClientes);
            $notificacao = Notificacoes::create([
                 'titulo' => 'Novo pedido',
                 'mensagem' => 'Olá ' .$cliente->nome.'! Novo pedido criado: #' . $pedido->codigo .
                 ' fique atento as notificações 
                 e acompanhe seu pedido!',
                 'dataEnvio' => NOW(),
                 // Outros campos da notificação, se houverem
             ]);
             NotificacoesClientes::create([
                 'idPedidos' => $pedido->id,
                 'idClientes' => $request->idClientes,
                'idNotificacoes' => $notificacao->id,
                 // Outros campos da notificação, se houverem
             ]); 
     
                // Redireciona após o processamento
                if(!$criacao){
                
                    return redirect()->route('pedidosDetalhes.index', ['codigo' => $pedido->codigo])
                    ->with('success', 'Serviço Selecionado com sucesso.');
                }else{
    
                return redirect()->route('website.produtos', ['codigo' => $pedido->codigo])
                    ->with('success', 'Serviço Selecionado com sucesso.');}
            }
            


}

