<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agendamentos;
use App\Models\Pedidos;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class AgendamentoController extends Controller
{
    public function index()
    {
        $agendamentos = Agendamentos::all();
        return view('adm.agendamentos', compact('agendamentos'));
    }

    public function show($idAgendamento)
    {
        $agendamento = Agendamentos::find($idAgendamento);
        
        if ($agendamento) {

            
            return response()->json($agendamento);
        } else {
            return response()->json(['error' => 'Agendamento não encontrado'], 404);
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
            $agendamento = $request->idAgendamento ? Agendamentos::findOrFail($request->idAgendamento) : new Agendamentos();
    
            // Preenche os outros campos do agendamento
            $agendamento->idPedidos = $request->input('idPedidos');
            $agendamento->dataInicio = $request->input('dataInicio');
            $agendamento->dataFim = $request->input('dataFim');
            $agendamento->horaInicio = $request->input('horaInicio');
            $agendamento->horaFim = $request->input('horaFim');
            $agendamento->observacao = $request->input('observacao');
            $agendamento->dataAtualizacao = now(); 
            if(!$request->idAgendamento){
                $agendamento->dataCadastro = now();
            }
            
            
             
            
            // Salva o cliente
            $agendamento->save();
            
            return redirect()->back()->with('success', 'Agendamento adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o agendamento: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o agendamento: ' . $e->getMessage()], 500);
        }
    }
    
    
    











    
    public function remover($idAgendamento)
    {
        try {

            
            $agendamento = Agendamentos::findOrFail($idAgendamento);
           
            
           


            $agendamento->delete();

            return response()->json(['message' => 'Agendamento excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o agendamento: ' . $e->getMessage()], 500);
        }       
    }
}
