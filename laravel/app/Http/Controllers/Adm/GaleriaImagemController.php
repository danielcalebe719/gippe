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


class GaleriaImagemController extends Controller
{
    public function index()
    {
        $galeriaImagens = GaleriaImagens::all();
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


        try {
            // Busca ou cria um novo cliente
            $galeriaImagem = $request->idGaleriaImagem ? GaleriaImagens::findOrFail($request->idGaleriaImagem) : new GaleriaImagens();

            // Preenche os outros campos do cliente
            $galeriaImagem->nomeImagem = $request->input('nomeImagem');
            $galeriaImagem->evento = $request->input('evento');
            $galeriaImagem->descricao = $request->input('descricao');
            $galeriaImagem->caminhoImagem = $request->input('caminhoImagem');

            // $galeriaImagem->tamanhoImagem = $request->input('tamanhoImagem');
            // $galeriaImagem->tipoImagem = $request->input('tipoImagem');


 // Trata o upload da imagem, se fornecida
 if ($request->hasFile('caminhoImagem')) {
    
    
    // Define o nome do arquivo usando o nome do produto e mantém a extensão original
    $nomeArquivo = $galeriaImagem->nomeImagem . '.' . $request->file('caminhoImagem')->getClientOriginalExtension();
    $path = $request->file('caminhoImagem')->storeAs('public/GaleriaImagens/eventoImagens', $nomeArquivo);
    // Deleta a imagem antiga, se existir
    if ($galeriaImagem->caminhoImagem && Storage::exists('public/GaleriaImagens/eventoImagens/' . $galeriaImagem->caminhoImagem)) {
        Storage::delete('public/GaleriaImagens/eventoImagens/' . $galeriaImagem->caminhoImagem);
    }
    // Atualiza o campo caminhoImagem com o nome do novo arquivo
    $galeriaImagem->caminhoImagem = $nomeArquivo;
} else {
    // Mantém o nome do arquivo existente se não houver uma nova imagem enviada
    $nomeArquivo = $galeriaImagem->caminhoImagem;
}




            // Salva o cliente
            $galeriaImagem->save();

            return redirect()->back()->with('success', 'Cliente adicionado/atualizado com sucesso!');

        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }















    public function remover($idGaleriaImagem)
    {
        try {


            $galeriaImagem = GaleriaImagens::findOrFail($idGaleriaImagem);


            // Excluir a imagem associada, se existir
            if ($galeriaImagem->imagemCaminho) {
                Storage::delete('public/GaleriaImagens/galeriaImagens/' . $galeriaImagem->imagemCaminho);
            }


            $galeriaImagem->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }
    }
}
