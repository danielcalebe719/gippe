<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GaleriaImagens; // Importe o modelo GaleriaImagem
use App\Models\Notificacoes;
use App\Models\NotificacoesClientes;
use Illuminate\Support\Facades\Auth;

class WebsiteIndexController extends Controller
{
    public function index()
{
    $notificacoes = collect(); // Inicializa uma coleção vazia de notificações

    if (Auth::guard('cliente')->check()) {
        $idClientes = Auth::guard('cliente')->user()->id;

        $notificacoes_clientes = NotificacoesClientes::where('idClientes', $idClientes)->get(); 

        $notificacoes_ids = $notificacoes_clientes->pluck('idNotificacoes');
        $notificacoes = Notificacoes::whereIn('id', $notificacoes_ids)->get();
    }

    $imagens = GaleriaImagens::all(); // Busca todas as imagens da tabela galeria_imagens

    return view('website.index', compact('imagens', 'notificacoes', 'notificacoes_clientes'));
}

}
