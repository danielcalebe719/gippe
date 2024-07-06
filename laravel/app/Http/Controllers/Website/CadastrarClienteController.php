<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\EnderecosClientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class CadastrarClienteController extends Controller

{
    
    public function MostrarFormularioCadastro()
    {
        return view('website.cadastro');
    }

    public function cadastrar(Request $request)
    {
        $this->validator($request->all())->validate();

        $cliente = $this->create($request->all());

        return redirect('/website/login')->with('success', 'Cliente registrado com sucesso!');
    }

    protected function validator(array $data)
    {
        // Define o locale como 'pt-BR' antes de chamar o validator
        App::setLocale('pt-BR');

        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Clientes::create([
           
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function carregar_dados(Request $request)
    {
        // Obtém o ID do cliente a partir da sessão
        $idCliente = Auth::guard('cliente')->user()->id;

        // Verifica se o ID do cliente foi encontrado
        if ($idCliente) {
            // Busca o cliente e os endereços associados
            $cliente = Clientes::find($idCliente);
            $enderecosClientes = EnderecosClientes::where('idClientes', $idCliente)->get();

            // Verifica se o cliente foi encontrado
            if ($cliente) {
                return view('website.cadastro2', compact('cliente', 'enderecosClientes'));
            } else {
                // Redireciona se o cliente não for encontrado
                return redirect()->back()->with('error', 'Cliente não encontrado.');
            }
        } else {
            // Redireciona se o ID do cliente não for encontrado na sessão
            return redirect()->back()->with('error', 'ID do cliente não encontrado na sessão.');
        }
    }
    

    public function guardar_cadastro_completo(Request $request)
    {
        $validatedData = $request->validate([
            'idClientes' => 'nullable|integer',
            'nome' => 'required|string|max:255',
            'cpf' => 'required|digits:11',
            'dob' => 'required|date',
            'cep' => 'required|digits:8',
            'cidade' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'rua' => 'required|string|max:255',
            'numero' => 'required|integer',
            'complemento' => 'nullable|string|max:255',
            'tipo' => 'required|in:residencial,comercial',
            'terms' => 'accepted',
        ]);
    
        // Verifica se há um ID de cliente na sessão
        $idCliente = $validatedData['idClientes'];
    
        try {
            // Inicia uma transação para garantir integridade dos dados
            DB::beginTransaction();
    
            if ($idCliente) {
                // Busca o cliente pelo ID
                $cliente = Clientes::findOrFail($idCliente);
    
                // Atualiza os dados do cliente
                $cliente->update([
                    'telefone' => $request->input('telefone'),
                    'cpf' => $validatedData['cpf'],
                    'nome' => $validatedData['nome'],
                    'dataNascimento' => $validatedData['dob'],
                ]);
            } else {
                // Cria um novo cliente
                $cliente = Clientes::create([
                    'cpf' => $validatedData['cpf'],
                    'nome' => $validatedData['nome'],
                    'telefone' => $request->input('telefone'),
                    'dataNascimento' => $validatedData['dob'],
                ]);
            }
    
            // Verifica se já existe um endereço associado ao cliente
            $endereco = EnderecosClientes::where('idClientes', $cliente->id)->first();
    
            if ($endereco) {
                // Atualiza o endereço existente
                $endereco->update([
                    'tipo' => $validatedData['tipo'],
                    'cep' => $validatedData['cep'],
                    'cidade' => $validatedData['cidade'],
                    'bairro' => $validatedData['bairro'],
                    'rua' => $validatedData['rua'],
                    'numero' => $validatedData['numero'],
                    'complemento' => $validatedData['complemento'],
                ]);
            } else {
                // Cria um novo endereço
                EnderecosClientes::create([
                    'tipo' => $validatedData['tipo'],
                    'cep' => $validatedData['cep'],
                    'cidade' => $validatedData['cidade'],
                    'bairro' => $validatedData['bairro'],
                    'rua' => $validatedData['rua'],
                    'numero' => $validatedData['numero'],
                    'complemento' => $validatedData['complemento'],
                    'idClientes' => $cliente->id,
                ]);
            }
    
            // Confirma a transação se tudo ocorrer bem
            DB::commit();
    
            return redirect()->route('website.servicos')->with('success', 'Cadastro atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Desfaz a transação em caso de erro
            DB::rollBack();
    
            return back()->withInput()->withErrors(['error' => 'Ocorreu um erro ao salvar os dados. Por favor, tente novamente mais tarde.']);
        }
    }
    
    
}    
