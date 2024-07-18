<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\PedidosProdutos;
use App\Models\PedidosServicos;
use App\Models\Agendamentos;
use App\Models\EnderecosClientes;
use App\Models\Servicos;
use App\Models\Clientes;
use App\Models\Feedbacks;
class PedidosDetalhesController extends Controller
{
    public function index($codigo)
    {

        $statuses = Pedidos::getStatusArray();
        unset($statuses[null]); // Remove the empty status

        // Obtendo informações do pedido
        $pedido = Pedidos::where('codigo', $codigo)->firstOrFail();
        
        // Obtendo produtos do pedido
        $produtos = PedidosProdutos::where('idPedidos', $pedido->id)->get();
        
        $cliente = Clientes::where('id', $pedido->idClientes)->first();

        $subtotal_produtos = 0;
        foreach ($produtos as $produto) {
            $subtotal_produtos += $produto->subtotal; // Ajuste aqui para usar $produto->subtotal
        }
    
        // Obtendo serviços do pedido (se houver)
        $servicos = Servicos::where('id', $pedido->idServicos)->first();
        
        // Obtendo pedidos de serviços do pedido
        $pedidos_servicos = PedidosServicos::where('idServicos', $pedido->idServicos)->get();
        
        // Obtendo agendamento do pedido
        $agendamento = Agendamentos::where('idPedidos', $pedido->id)->first();
        
        // Obtendo endereço do cliente
        $endereco = EnderecosClientes::where('id', $pedido->idEnderecos)->first()    ;


       
        // Renderizando a visualização com os dados obtidos
        return view('website.pedidosDetalhes', compact('cliente','pedido', 'produtos', 'servicos', 'pedidos_servicos', 'agendamento', 'endereco', 'subtotal_produtos', 'statuses'));
    }




    public function atualizar_endereco(Request $request)
    {
    $id = $request->idEnderecos;
        // Validação dos dados
        $request->validate([
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:50',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'cep' => 'required|string|max:20',
        ]);

        // Encontrar o endereço pelo ID
        $endereco = EnderecosClientes::findOrFail($id);

        // Atualizar os dados do endereço
        $endereco->update($request->all());

        // Redirecionar com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Endereço atualizado com sucesso!');
    }
    

    public function atualizar_cliente(Request $request)
    {
        $id = $request->idClientes;
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'dataNascimento' => 'required|date',
        ]);

        // Encontrar o cliente pelo ID
        $cliente = Clientes::findOrFail($id);

        // Atualizar os dados do cliente
        $cliente->update($request->all());

        // Redirecionar com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Informações do cliente atualizadas com sucesso!');
    }

    public function feedback($codigo)
    {
        $pedido = Pedidos::where('codigo', $codigo)->firstOrFail();

        return view('website.feedback', compact('codigo', 'pedido'));
    }

    public function feedback_salvar(Request $request)
{
    // Validação dos dados
    $request->validate([
        'avaliacao' => 'required|integer|min:1|max:5',
        'mensagem' => 'required|string|max:1000',
        'idPedidos' => 'required|integer|exists:pedidos,id', // Certifique-se de validar a existência do pedido
       
    ]);

    // Criação do feedback
    $feedback = new Feedbacks();
    $feedback->avaliacao = $request->input('avaliacao');
    $feedback->mensagem = $request->input('mensagem');
    $feedback->idPedidos = $request->input('idPedidos');
    $feedback->dataMensagem = NOW();
    $feedback->save();

    // Redirecionamento com mensagem de sucesso
    return redirect()->route('website.index')->with('success', 'Feedback enviado com sucesso!');
}

}
