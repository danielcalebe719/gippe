<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\EnderecosClientes;
use App\Models\NotificacoesClientes;
use App\Models\Pedidos;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Clientes::with('enderecos')->get();
        return view('adm.clientes', compact('clientes'));
    }

    public function show($idClientes)
    {
        $cliente = Clientes::find($idClientes);
        
        if ($cliente) {

            
            return response()->json($cliente);
        } else {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        }
    }

    public function showEnderecos($idEndereco)
    {
        $enderecos = EnderecosClientes::where('idClientes', $idEndereco)->get();
        
        // Verifica se encontrou algum endereço
    if ($enderecos->isNotEmpty()) {
        return response()->json($enderecos);
    } else {
        return response()->json(['error' => 'Cliente não encontrado ou sem endereços'], 404);
    }
    }

    public function showEndereco($idEndereco)
    {
        $endereco = EnderecosClientes::find($idEndereco);
        
        if ($endereco) {

            
            return response()->json($endereco);
        } else {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        }
    }
    
    
    public function guardar(Request $request)
    {
          
    
        try {
            // Busca ou cria um novo cliente
            $cliente = $request->idCliente ? Clientes::findOrFail($request->idCliente) : new Clientes();
    
            // Preenche os outros campos do cliente
            $cliente->nome = $request->input('nome');
            $cliente->cpf = preg_replace('/\D/', '', $request->input('cpf'));
            $cliente->dataNascimento = $request->input('dataNascimento');
            $cliente->status = $request->input('status');
            $cliente->email = $request->input('email');
            $cliente->telefone = $request->input('telefone');
    
            // Verifica se foi fornecida uma nova senha
            if ($request->filled('senha')) {
                $cliente->password = Hash::make($request->input('senha'));
            }
            
            if(!$request->idCliente){
                $cliente->dataCadastro = now();
            }
            // Trata o upload da imagem, se fornecida
if ($request->hasFile('caminhoImagem')) {
    
    
    // Define o nome do arquivo usando o nome do produto e mantém a extensão original
    $nomeArquivo = $cliente->nome . '.' . $request->file('caminhoImagem')->getClientOriginalExtension();
    $path = $request->file('caminhoImagem')->storeAs('public/GaleriaImagens/clientes', $nomeArquivo);
    // Deleta a imagem antiga, se existir
    if ($cliente->caminhoImagem && Storage::exists('public/GaleriaImagens/clientes/' . $cliente->caminhoImagem)) {
        Storage::delete('public/GaleriaImagens/clientes/' . $cliente->caminhoImagem);
    }
    // Atualiza o campo caminhoImagem com o nome do novo arquivo
    $cliente->caminhoImagem = $nomeArquivo;
} else {
    // Mantém o nome do arquivo existente se não houver uma nova imagem enviada
    $nomeArquivo = $cliente->caminhoImagem;
}

    
            // Atualiza o timestamp de atualização
            $cliente->dataAtualizacao = now();  
    
            // Salva o cliente
            $cliente->save();
            
            return redirect()->back()->with('success', 'Cliente adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }

    public function guardarEndereco(Request $request)
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
            $endereco = $request->idEndereco ? EnderecosClientes::findOrFail($request->idEndereco) : new EnderecosClientes();
    
            // Preenche os outros campos do cliente
            $endereco->tipo = $request->input('tipo');
            $endereco->cep = $request->input('cep');
            $endereco->cidade = $request->input('cidade');
            $endereco->bairro = $request->input('bairro');
            $endereco->rua = $request->input('rua');
            $endereco->numero = $request->input('numero');
            $endereco->complemento = $request->input('complemento');
            $endereco->idClientes = $request->input('idClientes');
    
            
    
            // Salva o cliente
            $endereco->save();
            
            return redirect()->back()->with('success', 'Cliente adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }
    
    
    






    public function removerEndereco($idEndereco)
    {
        try {

            
            $enderecocliente = EnderecosClientes::findOrFail($idEndereco);
            
           
            
            


            $enderecocliente->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }       
    }





    
    public function remover($idCliente)
    {
        try {

            $notificacoesclientes = NotificacoesClientes::where('idClientes',$idCliente)->delete();
            $enderecosclientes = EnderecosClientes::where('idClientes',$idCliente)->delete();
            $pedido = Pedidos::where('idClientes',$idCliente)->delete();
            $cliente = Clientes::findOrFail($idCliente);
           
            
            // Excluir a imagem associada, se existir
            if ($cliente->caminhoImagem) {
                Storage::delete('public/GaleriaImagens/clientes' . $cliente->caminhoImagem);
            }


            $cliente->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }       
    }
}
