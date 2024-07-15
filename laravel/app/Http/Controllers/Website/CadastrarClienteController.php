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
        // Validação dos dados recebidos do formulário
        $this->validator($request->all())->validate();
    
        // Criação do cliente no banco de dados
        $cliente = $this->create($request->all());
    
        // Retorna uma resposta JSON indicando sucesso
        return response()->json([
            'success' => true,
            'message' => 'Cliente registrado com sucesso!'
        ]);
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
           // dd($cliente->dataNascimento);

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
            // Validação básica para campos do cliente
            $baseValidation = [
                'idClientes' => 'nullable|integer',
                'nome' => 'required|string|max:255',
                'cpf' => 'required|digits:11',
                'dataNascimento' => 'required|date',
                'telefone' => 'required|digits_between:10,11',
                'terms' => 'accepted',
                'endereco_select' => 'required|string',
            ];
        
            // Validação adicional para novo endereço
            $addressValidation = [
            'cep' => 'required|digits:8',
                'cidade' => 'required|string|max:255',
                'bairro' => 'required|string|max:255',
                'rua' => 'required|string|max:255',
                'numero' => 'required|integer',
                'complemento' => 'nullable|string|max:255',
                'tipo' => 'required|in:residencial,comercial',
            ];
        
            // Combina as regras de validação baseado na seleção do endereço
            $validationRules = $baseValidation;
            if ($request->input('endereco_select') == 'novo') {
                $validationRules = array_merge($validationRules, $addressValidation);
            }
        
            $validatedData = $request->validate($validationRules, [
                 'idClientes.integer' => 'O ID do cliente deve ser um número inteiro.',
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.string' => 'O campo nome deve ser uma string.',
                'nome.max' => 'O campo nome não pode ter mais de 255 caracteres.',
                'cpf.required' => 'O campo CPF é obrigatório.',
                'cpf.digits' => 'O CPF deve conter exatamente 11 dígitos.',
                'dataNascimento.required' => 'O campo data de nascimento é obrigatório.',
                'dataNascimento.date' => 'O campo data de nascimento deve ser uma data válida.',
                'telefone.required' => 'O campo telefone é obrigatório.',
                'telefone.digits_between' => 'O telefone deve ter entre 10 e 11 dígitos.',
                'terms.accepted' => 'Você deve concordar com os termos e condições.',
                'endereco_select.required' => 'A seleção de endereço é obrigatória.',
                'endereco_select.string' => 'A seleção de endereço deve ser uma string.',
                
                // Mensagens para novo endereço
                'cep.required' => 'O campo CEP é obrigatório.',
                'cep.digits' => 'O CEP deve conter exatamente 8 dígitos.',
                'cidade.required' => 'O campo cidade é obrigatório.',
                'cidade.string' => 'O campo cidade deve ser uma string.',
                'cidade.max' => 'O campo cidade não pode ter mais de 255 caracteres.',
                'bairro.required' => 'O campo bairro é obrigatório.',
                'bairro.string' => 'O campo bairro deve ser uma string.',
                'bairro.max' => 'O campo bairro não pode ter mais de 255 caracteres.',
                'rua.required' => 'O campo rua é obrigatório.',
                'rua.string' => 'O campo rua deve ser uma string.',
                'rua.max' => 'O campo rua não pode ter mais de 255 caracteres.',
                'numero.required' => 'O campo número é obrigatório.',
                'numero.integer' => 'O campo número deve ser um número inteiro.',
                'complemento.string' => 'O campo complemento deve ser uma string.',
                'complemento.max' => 'O campo complemento não pode ter mais de 255 caracteres.',
                'tipo.required' => 'O campo tipo de endereço é obrigatório.',
                'tipo.in' => 'O tipo de endereço deve ser residencial ou comercial.'
            ]);
        

            $idCliente = $validatedData['idClientes'];
        
            try {
                DB::beginTransaction();
        
                if ($idCliente) {
                    $cliente = Clientes::findOrFail($idCliente);
                    $cliente->update([
                        'telefone' => $request->input('telefone'),
                        'cpf' => $validatedData['cpf'],
                        'nome' => $validatedData['nome'],
                        'dataNascimento' => $request['dataNascimento'],
                    ]);
                } else {
                    $cliente = Clientes::create([
                        'cpf' => $validatedData['cpf'],
                        'nome' => $validatedData['nome'],
                        'telefone' => $request->input('telefone'),
                        'dataNascimento' => $request['dataNascimento'],   
                    ]);
                }
        
                $endereco_cliente = null;
        
                if ($request->input('endereco_select') == 'novo') {
                    // Cria um novo endereço
                    $endereco_cliente = EnderecosClientes::create([
                        'tipo' => $validatedData['tipo'],
                        'cep' => $validatedData['cep'],
                        'cidade' => $validatedData['cidade'],
                        'bairro' => $validatedData['bairro'],
                        'rua' => $validatedData['rua'],
                        'numero' => $validatedData['numero'],
                        'complemento' => $validatedData['complemento'] ?? null,
                        'idClientes' => $cliente->id,
                    ]);
                } else {
                    // Seleciona o endereço existente
                    $endereco_cliente = EnderecosClientes::findOrFail($request->input('endereco_select'));
                }
        
                DB::commit();
        
                return response()->json([
                    'success' => true,
                    'message' => 'Cadastro atualizado com sucesso!',
                    'endereco_cliente' => $endereco_cliente,
                ]);
                
                
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'error' => true,
                    'message' => 'Erro ao completar o cadastro: ' . $e->getMessage()
                ]);
            }
        }
        
    

}    
