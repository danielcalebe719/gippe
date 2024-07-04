<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GaleriaImagens;
use App\Models\EnderecosClientes;
use App\Models\NotificacoesClientes;
use App\Models\Pedidos;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class GaleriaImagensController extends Controller
{
    public function index()
    {
        $galeriaImagem = GaleriaImagens::all();
        return view('adm.galeriaImagens', compact('galeriaImagens'));
    }

    public function show($idGaleriasImagens)
    {
        $galeriaImagem = GaleriaImagens::find($idGaleriasImagens);
        
        if ($galeriaImagem) {

            
            return response()->json($galeriaImagem);
        } else {
            return response()->json(['error' => 'Imagem não encontrada'], 404);
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
            $galeriaImagem = $request->idGaleriaImagem ? Clientes::findOrFail($request->idGaleriaImagem) : new Clientes();
    
            // Preenche os outros campos do cliente
            $galeriaImagem->evento = $request->input('evento');
            $galeriaImagem->descricao = $request->input('descricao');
            $galeriaImagem->nomeImagem = $request->input('nomeImagem');
            $galeriaImagem->tamanhoImagem = $request->input('tamanhoImagem');
            $galeriaImagem->tipoImagem = $request->input('tipoImagem');
            $galeriaImagem->imagemCaminho = $request->input('imagemCaminho');
    
            // Verifica se foi fornecida uma nova senha
            if ($request->filled('senha')) {
                $galeriaImagem->senha = Hash::make($request->input('senha'));
            }
    
            // Trata o upload da imagem, se fornecida
            if ($request->hasFile('imgCaminho')) {
                // Deleta a imagem antiga, se existir
                if ($galeriaImagem->imgCaminho && Storage::exists('public/GaleriaImagens/' . $galeriaImagem->imgCaminho)) {
                    Storage::delete('public/GaleriaImagens/' . $galeriaImagem->imgCaminho);
                }
                
                // Armazena a nova imagem
                $path = $request->file('imgCaminho')->store('public/GaleriaImagens');
                $galeriaImagem->imgCaminho = basename($path);
            }
    
            // Atualiza o timestamp de atualização
            $galeriaImagem->dataAtualizacao = now();  
    
            // Salva o cliente
            $galeriaImagem->save();
            
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
            $galeriaImagem = Clientes::findOrFail($idCliente);
           
            
            // Excluir a imagem associada, se existir
            if ($galeriaImagem->imgCaminho) {
                Storage::delete('public/GaleriaImagens/' . $galeriaImagem->imgCaminho);
            }


            $galeriaImagem->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }       
    }
}
