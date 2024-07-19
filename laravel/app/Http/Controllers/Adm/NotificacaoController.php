<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notificacoes;
use App\Models\NotificacoesClientes;
use App\Models\NotificacoesColaboradores;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class NotificacaoController extends Controller
{
    

    public function index()
{
    $notificacaoCliente = Notificacoes::whereIn('id', function($query) {
        $query->select('idNotificacoes')
              ->from('notificacoes_clientes');
    })->get();
    
    $notificacaoColaborador = Notificacoes::whereIn('id', function($query) {
        $query->select('idNotificacoes')
              ->from('notificacoes_colaboradores');
    })->get();
    
    return view('adm.notificacoes', compact('notificacaoCliente', 'notificacaoColaborador'));
}




public function show($idNotificacoes)
{
    $notificacao = Notificacoes::with(['notificacoesClientes', 'notificacoesColaboradores'])->find($idNotificacoes);

    if ($notificacao) {
        return response()->json($notificacao);
    } else {
        return response()->json(['error' => 'Notificação não encontrada'], 404);
    }
}


    
    
    
    public function guardarCliente(Request $request)
{
    
    DB::beginTransaction();

    try {
        // Busca ou cria uma nova notificação
        $notificacao = $request->idNotificacao ? Notificacoes::findOrFail($request->idNotificacao) : new Notificacoes();
        
        $notificacao->titulo = $request->input('titulo');
        $notificacao->mensagem = $request->input('mensagem');
        
        if (!$request->idNotificacao) {
            $notificacao->dataEnvio = now();
        }
        
        // Salva a notificação
        $notificacao->save();

        // ID da nova notificação salva
        $newId = $notificacao->id;

        // Cria ou atualiza a associação NotificacoesClientes
        $nc = $request->idNotificacao ? NotificacoesClientes::where('idNotificacoes', $newId)->first() : new NotificacoesClientes();
        $nc->idNotificacoes = $newId;
        $nc->idPedidos = $request->input('idPedidos');
        $nc->idClientes = $request->input('idClientes');
        $nc->save();
        
        DB::commit();
        
        return redirect()->back()->with('success', 'Cliente adicionado/atualizado com sucesso!');
        
    } catch (\Exception $e) {
        DB::rollBack();
        // Loga o erro para fins de debug
        Log::error('Erro ao atualizar o cliente: ' . $e->getMessage());
        return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
    }
}

public function guardarAdmin(Request $request)
{
    
    DB::beginTransaction();

    try {
        // Busca ou cria uma nova notificação
        $notificacao = $request->idNotificacao ? Notificacoes::findOrFail($request->idNotificacao) : new Notificacoes();
        
        $notificacao->titulo = $request->input('titulo');
        $notificacao->mensagem = $request->input('mensagem');
        
        if (!$request->idNotificacao) {
            $notificacao->dataEnvio = now();
        }
        
        // Salva a notificação
        $notificacao->save();

        // ID da nova notificação salva
        $newId = $notificacao->id;

        // Cria ou atualiza a associação NotificacoesClientes
        $nc = $request->idNotificacao ? NotificacoesColaboradores::where('idNotificacoes', $newId)->first() : new NotificacoesColaboradores();
        $nc->idNotificacoes = $newId;
        $nc->idPedidos = $request->input('idPedidos');
        $nc->idAdmins = $request->input('idAdmins');
        $nc->save();
        
        DB::commit();
        
        return redirect()->back()->with('success', 'Cliente adicionado/atualizado com sucesso!');
        
    } catch (\Exception $e) {
        DB::rollBack();
        // Loga o erro para fins de debug
        Log::error('Erro ao atualizar o cliente: ' . $e->getMessage());
        return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
    }
}


    

public function removerCliente($idNotificacao)
{
    try {
        // Encontra a notificação do cliente usando a chave estrangeira idNotificacao
        $notificacaoCliente = NotificacoesClientes::where('idNotificacoes', $idNotificacao)->first();

        // Verifica se a notificação do cliente existe
        if ($notificacaoCliente) {
            $notificacaoCliente->delete();
        }

        // Encontra a notificação usando o idNotificacao
        $notificacao = Notificacoes::find($idNotificacao);

        // Verifica se a notificação existe
        if ($notificacao) {
            $notificacao->delete();
        }

        return response()->json(['message' => 'Cliente excluído com sucesso']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
    }
}

public function removerColaborador($idNotificacao)
{
    try {
        // Encontra a notificação do cliente usando a chave estrangeira idNotificacao
        $notificacaoColaborador = NotificacoesColaboradores::where('idNotificacoes', $idNotificacao)->first();

        // Verifica se a notificação do cliente existe
        if ($notificacaoColaborador) {
            $notificacaoColaborador->delete();
        }

        // Encontra a notificação usando o idNotificacao
        $notificacao = Notificacoes::find($idNotificacao);

        // Verifica se a notificação existe
        if ($notificacao) {
            $notificacao->delete();
        }

        return response()->json(['message' => 'Cliente excluído com sucesso']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
    }
}

}
