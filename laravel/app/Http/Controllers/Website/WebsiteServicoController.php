<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Servicos;
use Illuminate\Http\Request;
use App\Models\PpServicos;

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

    public function salvar_personalizado(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
        /*    'barmans' => 'required|integer|min:0|max:999',
            'garcons' => 'required|integer|min:0|max:999',
            'cozinheiros' => 'required|integer|min:0|max:999',
            'quantidadePessoas' => 'required|integer|min:0|max:999',
            'duracaoHoras' => 'required|integer|min:1|max:24',*/
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


        // Criação dos pedidos de serviço associados
        //dd($request->tipo);
        foreach($request->tipo as $chave=>$valor){
            $ps = new PpServicos;
            $ps->idServicos = $servico->id;
            $ps->funcionarioTipo = $chave;
            $ps->quantidade = $valor;
            $ps->subtotal = 2; // conforme a lógica depois
           // dd($pedidos_servicos);
            $ps->save();
        }
        // Redireciona após o processamento
        return redirect()->route('')->with('success', 'Serviço personalizado criado com sucesso.');
    }


}

