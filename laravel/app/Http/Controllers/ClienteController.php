<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Carbon;
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
    

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:clientes|max:14',
            'dataNascimento' => 'required|date',
            'status' => 'required|in:ativo,inativo',
            'email' => 'required|string|email|unique:clientes|max:255',
            'senha' => 'required|string|min:6',
            'imgPerfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload da imagem de perfil, se fornecida
        if ($request->hasFile('imgPerfil')) {
            $path = $request->file('imgPerfil')->store('public/GaleriaImagens');
            $imgCaminho = basename($path);
        } else {
            $imgCaminho = null;
        }

        // Criação do cliente no banco de dados
       

// ...

$cliente = new Cliente();
$cliente->nome = $request->nome;
$cliente->cpf = $request->cpf;
$cliente->dataNascimento = $request->dataNascimento;
$cliente->status = $request->status;
$cliente->email = $request->email;
$cliente->senha = bcrypt($request->senha); // Recomendado para armazenamento seguro da senha
$cliente->imgCaminho = $imgCaminho;

$dataAtual = Carbon::now();
$cliente->dataCadastro = $dataAtual;    
$cliente->dataAtualizacao = $dataAtual;

$cliente->save();

        // Redirecionamento ou resposta de sucesso
        return redirect()->back()->with('success', 'Cliente adicionado com sucesso!');
    }

}