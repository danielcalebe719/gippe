<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

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
        return response()->json($cliente);
    }

    public function update(Request $request, $idClientes)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf,' . $idClientes . ',idClientes',
            'dataNascimento' => 'required|date',
            'status' => 'required|string',
            'email' => 'required|email|max:255|unique:clientes,email,' . $idClientes . ',idClientes',
            // Adicione outras regras de validação conforme necessário
        ]);
    
        try {
            // Buscar o cliente pelo idClientes
            $cliente = Cliente::findOrFail($idClientes);
    
            // Atribuir os novos valores ao cliente
            $cliente->nome = $request->input('nome');
            $cliente->cpf = $request->input('cpf');
            $cliente->dataNascimento = $request->input('dataNascimento');
            $cliente->status = $request->input('status');
            $cliente->email = $request->input('email');
            
            // Salvar as alterações
            $cliente->save();
    
            return response()->json(['message' => 'Cliente atualizado com sucesso']);
        } catch (\Exception $e) {
            // Capturar e tratar exceções, se necessário
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }
    

}