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
            $servico->imgCaminho = $request->input('imgCaminho');
            $servico->duracaoHoras = $request->input('duracaoHoras');
            $servico->quantidadePessoas = $request->input('quantidadePessoas');
            $servico->imgCaminho = $request->input('imgCaminho');

            if(!$request->idServico){
                $servico->dataCadastro = now();
            }
    
            
    
            // Trata o upload da imagem, se fornecida
            if ($request->hasFile('imgCaminho')) {
                // Deleta a imagem antiga, se existir
                if ($servico->imgCaminho && Storage::exists('public/GaleriaImagens/' . $servico->imgCaminho)) {
                    Storage::delete('public/GaleriaImagens/' . $servico->imgCaminho);
                }
                
                // Armazena a nova imagem
                $path = $request->file('imgCaminho')->store('public/GaleriaImagens');
                $servico->imgCaminho = basename($path);
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

            $pedidosservicos = PedidosServicos::where('idServicos',$idServico)->delete();
            $servico = Clientes::findOrFail($idServico);
           
            
            // Excluir a imagem associada, se existir
            if ($servico->imgCaminho) {
                Storage::delete('public/GaleriaImagens/' . $servico->imgCaminho);
            }


            $servico->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }       
    }
}
