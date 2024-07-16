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
        // Busca o pedido pelo código
        $pedido = Pedidos::where('codigo', $codigo)->first();
        

        // Busca o agendamento relacionado ao pedido
        $agendamento = Agendamentos::where('idPedidos', $pedido->id)->first();

        if($agendamento != null){
            $criacao = false;
        }else{
         
            $criacao = true;
        }
        // Passa os dados para a view
        return view('website.agendamento', compact('codigo', 'pedido', 'agendamento', 'criacao'));
    }

    public function salvar(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string',
            'dataInicio' => 'required|date',
            'dataFim' => 'required|date|after_or_equal:dataInicio',
            'horaInicio' => 'required',
            'horaFim' => 'required|after:horaInicio',
            'observacao' => 'nullable|string|max:255',
        ], [
            'codigo.required' => 'O código é obrigatório.',
            'codigo.string' => 'O código deve ser uma string válida.',
            'dataInicio.required' => 'A data de início é obrigatória.',
            'dataInicio.date' => 'A data de início deve ser uma data válida.',
            'dataFim.required' => 'A data de fim é obrigatória.',
            'dataFim.date' => 'A data de fim deve ser uma data válida.',
            'dataFim.after_or_equal' => 'A data de fim deve ser igual ou posterior à data de início.',
            'horaInicio.required' => 'O horário de início é obrigatório.',
            'horaFim.required' => 'O horário de fim é obrigatório.',
            'horaFim.after' => 'O horário de fim deve ser posterior ao horário de início.',
            'observacao.string' => 'A observação deve ser uma string válida.',
            'observacao.max' => 'A observação não pode ter mais de 255 caracteres.',
        ]);
    
        $codigo = $request->codigo;
        $pedido = Pedidos::where('codigo', $codigo)->first();
    
        if (!$pedido) {
            return redirect()->back()->with('error', 'Pedido não encontrado.');
        }
    
        // Verifica se já existe um agendamento
        $agendamento = Agendamentos::where('idPedidos', $pedido->id)->first();
    
        // Se não existir, cria um novo agendamento
        if (!$agendamento) {
            $agendamento = new Agendamentos();
            $agendamento->dataCadastro = now(); // Define a data de cadastro apenas na inserção
            $criacao = true;
        } else {
            $criacao = false; // Define que está atualizando um agendamento existente
        }
    
        // Atualiza os dados do agendamento
        $agendamento->idPedidos = $pedido->id;
        $agendamento->dataInicio = $request->dataInicio;
        $agendamento->dataFim = $request->dataFim;
        $agendamento->horaInicio = $request->horaInicio;
        $agendamento->horaFim = $request->horaFim;
        $agendamento->observacao = $request->observacao;
    
        // Atualiza o pedido
        DB::table('pedidos')
            ->where('id', $pedido->id)
            ->update([
                'observacao' => $request->observacao,
                'dataEntrega' => $agendamento->dataInicio,
                'status' => '2',
            ]);
    
        // Salva o agendamento
        $agendamento->save();
    
        // Redireciona com mensagens apropriadas
        if ($criacao) {
            return redirect()->route('website.index')->with('success', "Pedido enviado com sucesso! Seu pedido está agora em análise. Fique de olho nas notificações para mais atualizações.");
        } else {
            return redirect()->route('pedidosDetalhes.index', ['codigo' => $pedido->codigo])
                ->with('success', 'Agendamento alterado com sucesso.');
        }
    }
    
}
