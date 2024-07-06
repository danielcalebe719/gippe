<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agendamentos;
use App\Models\Pedidos;
use Illuminate\Support\Facades\DB;
class WebsiteAgendamentoController extends Controller
{
    public function index(Request $request, $codigo)
{
    $codigo = $request->codigo;

    return view('website.agendamento', compact('codigo'));
}
public function salvar(Request $request)
{
    $codigo = $request['codigo'];
    $pedido = Pedidos::where('codigo', $codigo)->first();

    $agendamento = new Agendamentos();
    $agendamento->idPedidos = $pedido->id;
    $agendamento->dataInicio = $request['dataInicio'];
    $agendamento->dataFim = $request['dataFim'];
    $agendamento->horaInicio = $request['horaInicio'];
    $agendamento->horaFim = $request['horaFim'];
    $agendamento->observacao = $request['observacao'];
    DB::table('pedidos')
    ->where('id', $pedido->id)
    ->update([
        'observacao' => $request['observacao'],
        'dataEntrega' => $agendamento['dataInicio'],
        'status' => 'pendente'
    ]);



    
    $agendamento->save();   

   
    // Redireciona o usuário para a página inicial (website.index)
    return redirect()->route('website.index');
}


}
