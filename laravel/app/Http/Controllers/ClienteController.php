<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\EnderecosClientes;
use App\Models\NotificacoesClientes;
use App\Models\Pedido;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('adm.clientes', compact('clientes'));
    }

    public function show($idClientes)
    {
        $cliente = Cliente::find($idClientes);
        if ($cliente) {
            return response()->json($cliente);
        } else {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        }
    }




    public function guardar(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'string|max:255',
            'cpf' => 'string|max:14|unique:clientes,cpf,' . $request->idCliente . ',idClientes',
            'dataNascimento' => 'date', // Removido o caractere extra antes de date
            'status' => 'string|in:ativo,inativo',
            'email' => 'email|max:255|unique:clientes,email,' . $request->idCliente . ',idClientes',
            'senha' => 'string|min:6',
            'telefone' => 'string|max:20',
            'imgCaminho' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        try {
            if ($request->idCliente) {
                $cliente = Cliente::findOrFail($request->idCliente);
            } else {
                $cliente = new Cliente();
            }
            $cliente->nome = $request->input('nome');
            $cliente->cpf = $request->input('cpf');
            $cliente->dataNascimento = $request->input('dataNascimento');
            $cliente->status = $request->input('status');
            $cliente->email = $request->input('email');
            $cliente->telefone = $request->input('telefone');
    
    
            $senha = $request->input('senha');
            if (!empty($senha)) {
                $cliente->senha = bcrypt($senha);
            } 
    
            $cliente->telefone = $request->input('telefone');
    
            if ($request->hasFile('imgCaminho')) {
                if ($cliente->imgCaminho) {
                    Storage::delete('public/GaleriaImagens/' . $cliente->imgCaminho);
                }
                
                $path = $request->file('imgCaminho')->store('public/GaleriaImagens');
                $cliente->imgCaminho = basename($path);
            }
    
            $cliente->dataAtualizacao = Carbon::now();
            $cliente->save();
    
            return redirect()->back()->with('success', 'Cliente adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }
    













    
    public function remover($idCliente)
    {
        try {

            $notificacoesclientes = NotificacoesClientes::where('idClientes',$idCliente)->delete();
            $enderecosclientes = EnderecosClientes::where('idClientes',$idCliente)->delete();
            //$pedido = Pedido::where('idClientes',$idCliente)->delete();
            $cliente = Cliente::findOrFail($idCliente);
            $cliente->pedidos->delete();
            
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
