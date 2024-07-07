<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MovimentacoesMateriasPrimas;
use App\Models\ReceitasItem;
use App\Models\MateriasPrimasEstoque;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class MateriaPrimaController extends Controller
{
    public function index()
    {
        $materiasPrimas = MateriasPrimasEstoque::all();
        return view('adm.MateriaPrimaEstoque', compact('materiasPrimas'));
    }

    public function show($idMateriasPrimas)
    {
        $materiaPrima = MateriasPrimasEstoque::find($idMateriasPrimas);
        
        if ($materiaPrima) {

            
            return response()->json($materiaPrima);
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
            $materiaPrima = $request->idMateriaPrima ? MateriasPrimasEstoque::findOrFail($request->idMateriaPrima) : new MateriasPrimasEstoque();
    
            // Preenche os outros campos do cliente
            $materiaPrima->nome = $request->input('nome');
            $materiaPrima->classificacao = $request->input('classificacao');
            $materiaPrima->quantidade = $request->input('quantidade');
            $materiaPrima->precoUnitario = $request->input('precoUnitario');
            $materiaPrima->caminhoImagem = $request->input('caminhoImagem');
            $materiaPrima->idFornecedor = $request->input('idFornecedor');

            if(!$request->idMateriaPrima){
                $materiaPrima->dataCadastro = now();
            }
    
            
    
          // Trata o upload da imagem, se fornecida
if ($request->hasFile('caminhoImagem')) {
    
    
    // Define o nome do arquivo usando o nome do produto e mantém a extensão original
    $nomeArquivo = $materiaPrima->nome . '.' . $request->file('caminhoImagem')->getClientOriginalExtension();
    $path = $request->file('caminhoImagem')->storeAs('public/GaleriaImagens/materiasPrimas', $nomeArquivo);
    // Deleta a imagem antiga, se existir
    if ($materiaPrima->caminhoImagem && Storage::exists('public/GaleriaImagens/materiasPrimas/' . $materiaPrima->caminhoImagem)) {
        Storage::delete('public/GaleriaImagens/materiasPrimas/' . $materiaPrima->caminhoImagem);
    }
    // Atualiza o campo caminhoImagem com o nome do novo arquivo
    $materiaPrima->caminhoImagem = $nomeArquivo;
} else {
    // Mantém o nome do arquivo existente se não houver uma nova imagem enviada
    $nomeArquivo = $materiaPrima->caminhoImagem;
}

    
            // Atualiza o timestamp de atualização
            $materiaPrima->dataAtualizacao = now();  
    
            // Salva o cliente
            $materiaPrima->save();
            
            return redirect()->back()->with('success', 'Cliente adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }
    
    
    











    
    public function remover($idMateriaPrima)
    {
        try {

            
            $materiaPrima = MateriasPrimasEstoque::findOrFail($idMateriaPrima);
           
            
            // Excluir a imagem associada, se existir
            if ($materiaPrima->imgCaminho) {
                Storage::delete('public/GaleriaImagens/' . $materiaPrima->imgCaminho);
            }


            $materiaPrima->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }       
    }
}
