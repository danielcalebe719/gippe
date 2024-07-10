<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notificacoes;
use App\Models\NotificacoesClientes;
use App\Models\NotificacoesColaboradores;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class NotificacaoController extends Controller
{
    // public function index()
    // {
    //     $notificacaoCliente = Notificacoes::where('idNotificacoes = id');
    //     $notificacaoColaborador = Notificacoes::where('idNotificacoes = id');
    //     return view('adm.notificacoes', compact('notificacaoCliente', 'notificacaoColaborador'));
    // }

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
        $notificacao = Clientes::find($idNotificacoes);
        
        if ($notificacao) {

            
            return response()->json($notificacao);
        } else {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        }
    }
    
    
    
    public function guardarCliente(Request $request)
    {
          
        
        try {
            // Busca ou cria um novo cliente
            $notificacao = $request->idNotificacao ? Notificacoes::findOrFail($request->idNotificacao) : new Notificacoes();
            
            Notificacoes::transaction(function () use($request, $notificacao) {
                $notificacao = [
                    'mensagem' =>   $request->input('mensagem'),
                    'titulo' =>  $request->input('titulo')
                ];
            
                $notificacaoCliente = [
                    'idPedidos' =>  $request->input('idPedidos'),
                    'idClientes' => $request->input('idClientes'),
                ];

                /*
                $n = new Notificacoes;
                $n->mensagem = 'Teste';
                $n->titulo = 'titulo';
                $n->save();
                $idNotificacao = $n->id;

                $nc = new NotificacoesClientes;
                $nc->idNotificacoes =  $idNotificacao;
                $nc->mensagem = 'Teste';
                $nc->titulo = 'titulo';
                $nc->save();
                */

            
                $not = Notificacoes::table('notificacoes')->insert($notificacao);
                $idNotificacao = $not->id;

                $notificacaoCliente['idNotificacao'] = $idNotificacao;
                Notificacoes::table('notificacoes_clientes')->insert($notificacaoCliente);
            });
            // Preenche os outros campos do cliente
           
            $notificacao->dataEnvio = now();
            
            // Salva o cliente
            $notificacao->save();
            
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

            $notificacoesclientes = NotificacoesClientes::where('idNotificacao',$idCliente)->delete();
            $enderecosclientes = NotificacoesColaboradores::where('idNotificacao',$idCliente)->delete();
            $pedido = Pedidos::where('idClientes',$idCliente)->delete();
            $cliente = Clientes::findOrFail($idCliente);
           
            
            // Excluir a imagem associada, se existir
            if ($cliente->imgCaminho) {
                Storage::delete('public/GaleriaImagens/' . $cliente->imgCaminho);
            }


            $cliente->delete();

            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente: ' . $e->getMessage()], 500);
        }       
    }
}
