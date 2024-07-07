<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GaleriaImagens; // Importe o modelo GaleriaImagem
use App\Models\Notificacoes;
use App\Models\NotificacoesClientes;
use App\Models\Mensagens;
use Illuminate\Support\Facades\Auth;

class WebsiteIndexController extends Controller
{
    public function index()
    {
        $notificacoes = collect(); 
        $notificacoes_clientes = collect(); 
        $quantidadeNotificacoes = 0; 
    
        if (Auth::guard('cliente')->check()) {
            $idClientes = Auth::guard('cliente')->user()->id;
    
            // Busca as notificações específicas do cliente logado
            $notificacoes_clientes = NotificacoesClientes::where('idClientes', $idClientes)->get();
            
            // Obtém os IDs das notificações do cliente
            $notificacoes_ids = $notificacoes_clientes->pluck('idNotificacoes');
    
            // Busca as notificações completas baseadas nos IDs obtidos
            $notificacoes = Notificacoes::whereIn('id', $notificacoes_ids)->get();
    
            // Conta a quantidade de notificações não lidas
            $quantidadeNotificacoes = $notificacoes->where('lido', false)->count();
          //  dd($quantidadeNotificacoes);
        }
    
        // Debug para verificar o conteúdo da coleção $notificacoes
       // foreach ($notificacoes as $notificacoes){
            //dd($notificacoes->id);
       // }
     
    
        $imagens = GaleriaImagens::all(); // Busca todas as imagens da tabela galeria_imagens
    
        return view('website.index', compact('imagens', 'notificacoes', 'notificacoes_clientes', 'quantidadeNotificacoes'));
    }
    

    

public function mensagem_guardar(Request $request)
{
    // Validação dos dados recebidos
    $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'assunto' => 'required|string|max:255',
        'mensagem' => 'required|string',
    ]);

    // Cria uma nova instância do modelo Mensagens
    $mensagem = new Mensagens();
    $mensagem->nome = $request->input('nome');
    $mensagem->email = $request->input('email');
    $mensagem->assunto = $request->input('assunto');
    $mensagem->mensagem = $request->input('mensagem');

    // Tenta salvar a mensagem no banco de dados
    try {
        $mensagem->save();
        // Retornar uma resposta de sucesso
        return redirect()->route('website.index')->with('success', 'Mensagem enviada com sucesso!');
    } catch (\Exception $e) {
        // Trate qualquer exceção aqui (por exemplo, log ou mensagem de erro)
        return redirect()->route('website.index')->with('error', 'Erro ao salvar a mensagem. Por favor, tente novamente.');

    }
}






public function marcarLida($id)
{
    try {
        // Buscar a notificação pelo ID
        $notificacaoCliente = Notificacoes::findOrFail($id);

        // Marcar a notificação como lida
        $notificacaoCliente->lido = true;
        $notificacaoCliente->save();

        // Redirecionar de volta à página anterior com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Notificação marcada como lida com sucesso.');
        
    } catch (\Exception $e) {
        // Caso ocorra algum erro ao encontrar a notificação
        return redirect()->back()->with('error', 'Erro ao marcar a notificação como lida: ' . $e->getMessage());
    }
}

}



