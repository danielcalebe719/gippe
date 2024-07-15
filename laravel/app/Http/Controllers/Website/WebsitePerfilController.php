<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agendamentos;
use App\Models\Pedidos;
use App\Models\Clientes;
use App\Models\EnderecosClientes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WebsitePerfilController extends Controller
{
   
     
    public function index()
    {
        if (Auth::guard('cliente')->check()) {
            $idCliente = Auth::guard('cliente')->user()->id;
            
            // Recupera o cliente
            $clientes = Clientes::where('id', $idCliente)->first();
            
            // Recupera todos os pedidos do cliente
            $pedidos = Pedidos::where('idClientes', $idCliente)->get();
            
            // Recupera o endereço do cliente
            $enderecos_clientes = EnderecosClientes::where('idClientes', $idCliente)->first();
            
            
            return view('website.perfil', compact('clientes', 'pedidos', 'enderecos_clientes'));
        }
        
        return redirect()->route('outra.rota');
    }
    

    
    


    public function salvar_dados_pessoais(Request $request)
    {
        $request->validate([
            /*'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'cpf' => 'required|string|max:11',
            'data_nascimento' => 'required|date',
            'senha' => 'nullable|string|min:6|max:255', // Senha é opcional*/
        ]);
    
        // Buscar o cliente pelo id da sessão (assumindo que está autenticado)
        $cliente = Clientes::find(Auth::guard('cliente')->id());
    
        if ($cliente) {
            // Atualizar os dados do cliente
            $cliente->nome = $request->nome;
            $cliente->email = $request->email;
            $cliente->telefone = $request->telefone;
            $cliente->cpf = $request->cpf;
            $cliente->dataNascimento = $request->data_nascimento;
    
            // Atualizar a senha somente se uma nova senha for fornecida
            if ($request->filled('senha')) {
                $cliente->password = Hash::make($request->senha);
            }
    
            // Salvar as alterações
            $cliente->save();
    
            // Redirecionar com mensagem de sucesso
            return redirect()->route('website.perfil')->with('success', 'Perfil atualizado com sucesso!');
        }
    
        // Redirecionar com mensagem de erro se o cliente não for encontrado
        return redirect()->route('website.perfil')->with('error', 'Falha ao atualizar o perfil.');
    }
    

public function salvar_endereco_cliente(Request $request){
     // Validação dos campos do formulário
     $request->validate([
       /* 'tipo' => 'required|string|max:255',
        'cep' => 'required|string|max:9',
        'cidade' => 'required|string|max:255',
        'bairro' => 'required|string|max:255',
        'rua' => 'required|string|max:255',
        'numero' => 'required|string|max:20',
        'complemento' => 'nullable|string|max:255',*/
    ]);

    // Verifica se é para adicionar ou editar
    if ($request->acao == 'adicionarEndereco') {
        // Cria um novo objeto EnderecosClientes
        $endereco = new EnderecosClientes();
    } else {
        // Busca o endereço existente pelo idClientes (assumindo que já existe)
        $endereco = EnderecosClientes::where('idClientes', $request->idClientes)->first();
    }

    // Preenche os campos do objeto EnderecosClientes com os dados do formulário
    $endereco->tipo = $request->tipo;
    $endereco->cep = $request->cep;
    $endereco->cidade = $request->cidade;
    $endereco->bairro = $request->bairro;
    $endereco->rua = $request->rua;
    $endereco->numero = $request->numero;
    $endereco->complemento = $request->complemento;

    // Salva o endereço no banco de dados
    $endereco->save();

    // Redireciona de volta para a página anterior (ou outra página desejada)
    return redirect()->back()->with('success', 'Endereço salvo com sucesso!');
}


public function salvar_imagem_perfil(Request $request)
{
    $request->validate([
        'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'idClientes' => 'required|integer',
    ]);

    if ($request->hasFile('imagem')) {
        $imagem = $request->file('imagem');
        $nomeImagem = time() . '_' . $imagem->getClientOriginalName();

        try {
            // Move a imagem para o diretório de armazenamento público
            $caminhoImagem = $imagem->storeAs('public/ImagensClientes', $nomeImagem);
            
            // Salva o caminho da imagem no banco de dados para o cliente específico
            $cliente = Clientes::findOrFail($request->idClientes);
            $cliente->caminhoImagem = $nomeImagem; // Changed to match the view
            $cliente->save();

            return redirect()->back()->with('success', 'Imagem de perfil atualizada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Falha ao fazer upload da imagem de perfil: ' . $e->getMessage());
        }
    }   
    
    return redirect()->back()->with('error', 'Nenhuma imagem foi enviada.');
}


}


