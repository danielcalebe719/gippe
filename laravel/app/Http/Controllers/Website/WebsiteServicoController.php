<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Servicos;
use Illuminate\Http\Request;
use App\Models\PpServicos;
use Illuminate\Support\Facades\DB;
use App\Models\Pedidos;
use Illuminate\Support\Str;

class WebsiteServicoController extends Controller
{
    public function index()
    {
        $servicos = Servicos::with('pedidos_servicos')
                            ->orderBy('id', 'asc')
                            ->limit(4)
                            ->get();

        return view('website.servicos', compact('servicos'));
    }

     function salvar_padrao(Request $request)
    {
        $pedido = new Pedidos();
        $pedido->idServicos = $request->idServicos;
        $pedido->idClientes = $request->idClientes;
    
        do {
            $codigo = 'PE' . Str::random(6) . mt_rand(10, 99);
        } while (Pedidos::where('codigo', $codigo)->exists());
    
        $pedido->codigo = $codigo;
        $pedido->status = 'nao_finalizado';
        $pedido->dataPedido = now();
    
        $pedido->save();
    


        $totalServicos = DB::table('servicos')
        ->where('id', $pedido->idServicos)
        ->value('totalServicos');
        //dd($totalServicos);

// Atualização do totalPedido na tabela pedidos
DB::table('pedidos')
->where('id', $pedido->id)
->update(['totalPedido' => $totalServicos]);

return redirect()->route('website.produtos', ['codigo' => $pedido->codigo])
->with('success', 'Serviço Selecionado com sucesso.');
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
    $servico->nomeServico = 'Personalizado'; 
    $servico->dataCadastro = now(); 
    $servico->dataAtualizacao = now(); 
    $servico->dataRemocao = null; 
    $servico->imgCaminho = null; 
    $servico->duracaoHoras = $request->duracaoHoras;
    $servico->quantidadePessoas = $request->quantidadePessoas;
    $servico->save();

    // Criação do pedido
    $pedido = new Pedidos();
    $pedido->idServicos = $servico->id;
    $pedido->idClientes = $request->idClientes;

    do {
        $codigo = 'PE' . Str::random(6) . mt_rand(10, 99);
    } while (Pedidos::where('codigo', $codigo)->exists());

    $pedido->codigo = $codigo;
    $pedido->dataPedido = now();  
    $pedido->totalPedido = $servico->totalServicos;
    $pedido->status = 'nao_finalizado';
    $pedido->save(); 



    // Criação dos pedidos de serviço associados
    foreach ($request->tipo as $chave => $valor) {
        $ps = new PpServicos();
        $ps->idServicos = $servico->id;
        $ps->funcionarioTipo = $chave;
        $ps->quantidade = $valor;
        $ps->subtotal = $valor * 150; // conforme a lógica depois
        $ps->save();
    }


    $totalServicos = DB::table('servicos')
    ->where('id', $pedido->idServicos)
    ->value('totalServicos');
    //dd($totalServicos);

// Atualização do totalPedido na tabela pedidos
DB::table('pedidos')
->where('id', $pedido->id)
->update(['totalPedido' => $totalServicos]);

    // Redireciona após o processamento
    return redirect()->route('website.produtos', ['codigo' => $pedido->codigo])
    ->with('success', 'Serviço Selecionado com sucesso.');


}

    


}

