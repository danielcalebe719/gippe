<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class ColaboradorController extends Controller
{
    public function index()
    {
        $clientes = Colaboradores::all();
        return view('adm.clientes', compact('clientes'));
    }

    public function show($idClientes)
    {
        $cliente = Colaboradores::find($idClientes);
        
        if ($cliente) {

            
            return response()->json($cliente);
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
            $cliente = $request->idCliente ? Colaboradores::findOrFail($request->idCliente) : new Colaboradores();
    
            // Preenche os outros campos do cliente
            $cliente->nome = $request->input('nome');
            $cliente->cpf = $request->input('cpf');
            $cliente->dataNascimento = $request->input('dataNascimento');
            $cliente->status = $request->input('status');
            $cliente->email = $request->input('email');
            $cliente->telefone = $request->input('telefone');
    
            // Verifica se foi fornecida uma nova senha
            if ($request->filled('senha')) {
                $cliente->senha = Hash::make($request->input('senha'));
            }
    
            // Trata o upload da imagem, se fornecida
            if ($request->hasFile('imgCaminho')) {
                // Deleta a imagem antiga, se existir
                if ($cliente->imgCaminho && Storage::exists('public/GaleriaImagens/' . $cliente->imgCaminho)) {
                    Storage::delete('public/GaleriaImagens/' . $cliente->imgCaminho);
                }
                
                // Armazena a nova imagem
                $path = $request->file('imgCaminho')->store('public/GaleriaImagens');
                $cliente->imgCaminho = basename($path);
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
    
    
    











    
    public function remover($idCliente)
    {
        try {

            $notificacoesclientes = NotificacoesClientes::where('idClientes',$idCliente)->delete();
            $enderecosclientes = EnderecosClientes::where('idClientes',$idCliente)->delete();
            $pedido = Pedidos::where('idClientes',$idCliente)->delete();
            $cliente = Clientes::findOrFail($idCliente);
           
            
            // Excluir a imagem associada, se existir
            if ($cliente->imgCaminho) {
                Storage::delete('public/GaleriaImagens/' . $cliente->imgCaminho);
            }


            $cliente->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }       
    }
}
