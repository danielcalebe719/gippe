<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificacoesClientes;
use App\Models\Pedidos;
use App\Models\Notificacoes;
use App\Models\GaleriaImagens;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View Composer para a navbar
        View::composer('partials.navbar', function ($view) {
            $notificacoes = collect();
            $quantidadeNotificacoes = 0;
            $pedidos = collect();
            $notificacoesAgrupadas = collect();
            $imagens = collect();

            if (Auth::guard('cliente')->check()) {
                $idCliente = Auth::guard('cliente')->user()->id;

                // Fetch notifications for the client
                $notificacoes_clientes = NotificacoesClientes::where('idClientes', $idCliente)->get();

                // Get unique pedido IDs
                $idsPedidos = $notificacoes_clientes->pluck('idPedidos')->unique();

                // Fetch pedidos
                $pedidos = Pedidos::whereIn('id', $idsPedidos)->get();

                // Fetch notifications
                $notificacoes = Notificacoes::whereIn('id', $notificacoes_clientes->pluck('idNotificacoes'))
                ->orderBy('id', 'desc')
                ->get();
            
                // Group notifications by pedido ID
                $notificacoesAgrupadas = $notificacoes->groupBy(function ($notificacao) use ($notificacoes_clientes) {
                    $notificacao_cliente = $notificacoes_clientes->where('idNotificacoes', $notificacao->id)->first();
                    return $notificacao_cliente ? $notificacao_cliente->idPedidos : null;
                });

                // Count unread notifications
                $quantidadeNotificacoes = $notificacoes->where('lido', false)->count();
            }

            // Fetch gallery images
            $imagens = GaleriaImagens::all();

            // Share the variables with the view
            $view->with(compact('imagens', 'pedidos', 'notificacoesAgrupadas', 'quantidadeNotificacoes'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
