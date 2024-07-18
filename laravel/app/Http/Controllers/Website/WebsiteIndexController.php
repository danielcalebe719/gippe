<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GaleriaImagens; // Importe o modelo GaleriaImagem
use App\Models\Notificacoes;
use App\Models\NotificacoesClientes;
use App\Models\Mensagens;
use App\Models\Pedidos;
use Illuminate\Support\Facades\Auth;

class WebsiteIndexController extends Controller
{
   
    public function index()
    {
        $notificacoes = collect();
        $quantidadeNotificacoes = 0;
        $pedidos = collect();
        $notificacoesAgrupadas = collect();
    
        if (Auth::guard('cliente')->check()) {
            $idCliente = Auth::guard('cliente')->user()->id;
    
            // Fetch notifications for the client
            $notificacoes_clientes = NotificacoesClientes::where('idClientes', $idCliente)->get();
    
            // Get unique pedido IDs
            $idsPedidos = $notificacoes_clientes->pluck('idPedidos')->unique();
    
            // Fetch pedidos
            $pedidos = Pedidos::whereIn('id', $idsPedidos)->get();
 
            // Fetch notifications
            $notificacoes = Notificacoes::whereIn('id', $notificacoes_clientes->pluck('idNotificacoes'))->get();
    
            // Group notifications by pedido ID
            $notificacoesAgrupadas = $notificacoes->groupBy(function ($notificacao) use ($notificacoes_clientes) {
                $notificacao_cliente = $notificacoes_clientes->where('idNotificacoes', $notificacao->id)->first();
                return $notificacao_cliente ? $notificacao_cliente->idPedidos : null;
            });
    
            // Count unread notifications
            $quantidadeNotificacoes = $notificacoes->where('lido', false)->count();
        }
    
        $imagens = GaleriaImagens::all();
    
        return view('website.index', compact('imagens', 'pedidos', 'notificacoesAgrupadas', 'quantidadeNotificacoes'));
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



