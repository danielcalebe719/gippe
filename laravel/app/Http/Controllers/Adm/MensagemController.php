<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mensagens;


use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class MensagemController extends Controller
{
    public function index()
    {
        $mensagens = Mensagens::all();
        return view('adm.mensagens', compact('mensagens'));
    }

    public function show($idMensagens)
    {
        $mensagem = Mensagens::find($idMensagens);
        
        if ($mensagem) {

            
            return response()->json($mensagem);
        } else {
            return response()->json(['error' => 'mensagem não encontrado'], 404);
        }
    }
    
    
    public function guardar(Request $request)
    {
         
    
        try {
            // Busca ou cria um novo fornecedor
            $mensagem = $request->idMensagem ? Mensagens::findOrFail($request->idMensagem) : new Mensagens();
    
            // Preenche os outros campos do mensagem
            $mensagem->nome = $request->input('nome');
            $mensagem->email = $request->input('email');
            $mensagem->assunto = $request->input('assunto');
            $mensagem->mensagem = $request->input('mensagem');
            
            if(!$request->idFornecedor){
                $mensagem->dataEnvio = now();
            }
            
            
    
            
    
              
    
            // Salva o cliente
            $mensagem->save();
            
            return redirect()->back()->with('success', 'Fornecedor adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o fornecedor: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o fornecedor: ' . $e->getMessage()], 500);
        }
    }
    
 
    
    public function remover($idMensagem)
    {
        try {

            // $materiasPrimasEstoque = MateriasPrimasEstoque::where('idFornecedor',$idFornecedor)->delete();
            $mensagem = Mensagens::findOrFail($idMensagem);
           
            
        


            $mensagem->delete();

            return response()->json(['message' => 'Fornecedor excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o fornecedor: ' . $e->getMessage()], 500);
        }       
    }
}
