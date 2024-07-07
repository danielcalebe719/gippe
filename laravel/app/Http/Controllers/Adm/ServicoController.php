<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\EnderecosClientes;
use App\Models\NotificacoesClientes;
use App\Models\Pedidos;
use App\Models\Servicos;
use App\Models\PedidosServicos;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class ServicoController extends Controller
{
    public function index()
    {
        $servicos = Servicos::all();
        return view('adm.servicos', compact('servicos'));
    }

    public function show($idServicos)
    {
        $servico = Servicos::find($idServicos);
        
        if ($servico) {

            
            return response()->json($servico);
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
            $servico = $request->idServico ? Servicos::findOrFail($request->idServico) : new Servicos();
    
            // Preenche os outros campos do cliente
            $servico->nome = $request->input('nome');
            $servico->totalServicos = $request->input('totalServicos');
            $servico->caminhoImagem = $request->input('caminhoImagem');
            $servico->duracaoHoras = $request->input('duracaoHoras');
            $servico->quantidadePessoas = $request->input('quantidadePessoas');
            

            if(!$request->idServico){
                $servico->dataCadastro = now();
            }
    
            
    
           // Trata o upload da imagem, se fornecida
if ($request->hasFile('caminhoImagem')) {
    
    
    // Define o nome do arquivo usando o nome do produto e mantém a extensão original
    $nomeArquivo = $servico->nome . '.' . $request->file('caminhoImagem')->getClientOriginalExtension();
    $path = $request->file('caminhoImagem')->storeAs('public/GaleriaImagens/servicos', $nomeArquivo);
    // Deleta a imagem antiga, se existir
    if ($servico->caminhoImagem && Storage::exists('public/GaleriaImagens/servicos/' . $servico->caminhoImagem)) {
        Storage::delete('public/GaleriaImagens/servicos/' . $servico->caminhoImagem);
    }
    // Atualiza o campo caminhoImagem com o nome do novo arquivo
    $servico->caminhoImagem = $nomeArquivo;
} else {
    // Mantém o nome do arquivo existente se não houver uma nova imagem enviada
    $nomeArquivo = $servico->caminhoImagem;
}

    
            // Atualiza o timestamp de atualização
            $servico->dataAtualizacao = now();  
    
            // Salva o cliente
            $servico->save();
            
            return redirect()->back()->with('success', 'Cliente adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }
    
    
    











    
    public function remover($idServico)
    {
        try {

            //$pedidosservicos = PedidosServicos::where('idServicos',$idServico)->delete();
            $servico = Servicos::findOrFail($idServico);
           
            
            // Excluir a imagem associada, se existir
            if ($servico->imgCaminho) {
                Storage::delete('public/GaleriaImagens/servicos' . $servico->imgCaminho);
            }


            $servico->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }       
    }
}
