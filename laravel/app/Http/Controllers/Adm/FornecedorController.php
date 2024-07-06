<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fornecedores;
use App\Models\MateriasPrimasEstoque;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedores::all();
        return view('adm.fornecedores', compact('fornecedores'));
    }

    public function show($idFornecedores)
    {
        $fornecedor = Fornecedores::find($idFornecedores);
        
        if ($fornecedor) {

            
            return response()->json($fornecedor);
        } else {
            return response()->json(['error' => 'fornecedor não encontrado'], 404);
        }
    }
    
    
    public function guardar(Request $request)
    {
         
    
        try {
            // Busca ou cria um novo fornecedor
            $fornecedor = $request->idFornecedor ? Fornecedores::findOrFail($request->idFornecedor) : new Fornecedores();
    
            // Preenche os outros campos do fornecedor
            $fornecedor->nome = $request->input('nome');
            $fornecedor->telefone1 = $request->input('telefone1');
            $fornecedor->telefone2 = $request->input('telefone2');
            $fornecedor->telefone3 = $request->input('telefone3');
            $fornecedor->email = $request->input('email');
            $fornecedor->cep = $request->input('cep');
            $fornecedor->estado = $request->input('estado');
            $fornecedor->cidade = $request->input('cidade');
            $fornecedor->rua = $request->input('rua');
            $fornecedor->numero = $request->input('numero');
            $fornecedor->complemento = $request->input('complemento');
            $fornecedor->status = $request->input('status');
            $fornecedor->cnpj = $request->input('cnpj');
            if(!$request->idFornecedor){
                $fornecedor->dataCadastro = now();
            }
            
            
    
            
    
            // Atualiza o timestamp de atualização
            $fornecedor->dataAtualizacao = now();  
    
            // Salva o cliente
            $fornecedor->save();
            
            return redirect()->back()->with('success', 'Fornecedor adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o fornecedor: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o fornecedor: ' . $e->getMessage()], 500);
        }
    }
    
    
    











    
    public function remover($idFornecedor)
    {
        try {

            // $materiasPrimasEstoque = MateriasPrimasEstoque::where('idFornecedor',$idFornecedor)->delete();
            $fornecedor = Fornecedores::findOrFail($idFornecedor);
           
            
        


            $fornecedor->delete();

            return response()->json(['message' => 'Fornecedor excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o fornecedor: ' . $e->getMessage()], 500);
        }       
    }
}
