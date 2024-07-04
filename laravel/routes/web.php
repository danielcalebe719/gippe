<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adm\ClienteController;
use App\Http\Controllers\Adm\PedidoController;
use App\Http\Controllers\Adm\NotificacaoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('website.index');
});
Route::get('/perfil', function () {
    return view('website.perfil');
});
Route::get('/agendamento', function () {
    return view('website.agendamento');
});
Route::get('/servicos', function () {
    return view('website.servicos');
});
Route::get('/login', function () {
    return view('website.login');
});
Route::get('/cadastro', function () {
    return view('website.cadastro');
});
Route::get('/cadastro2', function () {
    return view('website.cadastro2');
});

Route::get('/produtos', function () {
    return view('website.produtos');
});*/

use App\Http\Controllers\Adm\Auth\CadastrarAdminController;
use App\Http\Controllers\Adm\Auth\AdminController;
use App\Http\Controllers\Adm\Auth\LoginAdminController;
use App\Http\Middleware\RedirectIfNotAdmin;

// Rota de login sem proteção de autenticação
Route::get('/adm/login', function () {
    return view('adm.login');
})->name('adm.login');

// Rota para processar o login
Route::post('/adm/login/logar', [LoginAdminController::class, 'logar'])->name('adm.login.logar');

// Rota para cadastro de administrador
Route::post('/adm/admin/cadastro', [CadastrarAdminController::class, 'cadastrar'])->name('adm.admin.cadastro');

// Grupo de rotas 'adm' protegido por autenticação admin
Route::middleware(['admin'])->prefix('adm')->group(function () {
    Route::get('/', function () {
        return view('adm.templates.template');
    });

    Route::get('/agendamentos', function () {
        return view('adm.agendamentos');
    })->name('adm.agendamentos');

    Route::get('/fornecedores', function () {
        return view('adm.fornecedores');
    })->name('adm.fornecedores');

    Route::get('/galeriaImagens', function () {
        return view('adm.galeriaImagens');
    })->name('adm.galeriaImagens');

    Route::get('/index', function () {
        return view('adm.index');
    })->name('adm.index');

    Route::get('/MateriaPrimaEstoque', function () {
        return view('adm.MateriaPrimaEstoque');
    })->name('adm.MateriaPrimaEstoque');

    Route::get('/mensagens', function () {
        return view('adm.mensagens');
    })->name('adm.mensagens');

    Route::get('/notificacoes', function () {
        return view('adm.notificacoes');
    })->name('adm.notificacoes');

    Route::get('/painel-financeiro', function () {
        return view('adm.painel-financeiro');
    })->name('adm.painel-financeiro');

    Route::get('/painel-operacional', function () {
        return view('adm.painel-operacional');
    })->name('adm.painel-operacional');

    Route::get('/pedidos', function () {
        return view('adm.pedidos');
    })->name('adm.pedidos');

    Route::get('/produtos', function () {
        return view('adm.produtos');
    })->name('adm.produtos');

    Route::get('/receitasItens', function () {
        return view('adm.receitasItens');
    })->name('adm.receitasItens');

    Route::get('/servicos', function () {
        return view('adm.servicos');
    })->name('adm.servicos');

    Route::get('/admins', function () {
        return view('adm.admins');
    })->name('adm.admins');

    // Rotas específicas para clientes dentro do grupo 'adm/clientes'
    Route::prefix('clientes')->group(function () {
        Route::get('/', [ClienteController::class, 'index'])->name('clientes.index');
        Route::get('/show/{idClientes}', [ClienteController::class, 'show'])->name('clientes.show');
        Route::post('/guardar', [ClienteController::class, 'guardar'])->name('clientes.guardar');
        Route::get('/remover/{idClientes}', [ClienteController::class, 'remover'])->name('clientes.remover');
    });

    // Rotas específicas para pedidos dentro do grupo 'adm/pedidos'
    Route::prefix('pedidos')->group(function () {
        Route::get('/', [PedidoController::class, 'index'])->name('pedidos.index');
        Route::get('/show/{idPedidos}', [PedidoController::class, 'show'])->name('pedidos.show');
        Route::post('/guardar', [PedidoController::class, 'guardar'])->name('pedidos.guardar');
        Route::get('/remover/{idPedidos}', [PedidoController::class, 'remover'])->name('pedidos.remover');
    });
    // Rotas específicas para pedidos dentro do grupo 'adm/pedidos'
    Route::prefix('notificacoes')->group(function () {
        Route::get('/', [NotificacaoController::class, 'index'])->name('notificacoes.index');
        Route::get('/show/{idNotificacoes}', [NotificacaoController::class, 'show'])->name('notificacoes.show');
    });
});
Route::get('adm/logout', [LoginAdminController::class, 'deslogar'])->name('logout');








Route::get('/adm/financeiro', function () {
    return view('adm.painel-financeiro'); // Esta view pode conter um iframe ou um redirecionamento para a porta onde o servidor Node.js está rodando
});

Route::get('/j', function () {
    return view('website.templates.menu');    
});

//exemplo cargos
Route::prefix('/cargos')->group(function () {
    Route::get('/', 'App\Http\Controllers\Administrativo\CargosController@index');
    Route::get('/cadastro', 'App\Http\Controllers\Administrativo\CargosController@cadastro');
    Route::get('/cadastro/{id}', 'App\Http\Controllers\Administrativo\CargosController@cadastro');
    Route::get('/remover/{id}', 'App\Http\Controllers\Administrativo\CargosController@remover');
});










use App\Http\Controllers\Website\WebsiteClienteController;
use App\Http\Controllers\Website\LoginClienteController;
use App\Http\Controllers\Website\CadastrarClienteController;
use App\Http\Controllers\Website\WebsiteIndexController;

// Rotas acessíveis sem autenticação
Route::get('/', function () {

    Route::get('/', [WebsiteIndexController::class, 'index'])->name('index');
})->name('index');

Route::get('website/login', [LoginClienteController::class, 'index'])->name('login');
Route::post('website/login', [LoginClienteController::class, 'logar'])->name('login.logar');

Route::get('website/cadastro', [CadastrarClienteController::class, 'MostrarFormularioCadastro'])->name('cadastro');

Route::post('website/cadastro', [CadastrarClienteController::class, 'cadastrar'])->name('cadastrar');


// Rotas do prefixo 'website'
Route::prefix('website')->group(function () {
    Route::get('/', [WebsiteIndexController::class, 'index'])->name('website.index');

    Route::get('/perfil', function () {
        return view('website.perfil');
    })->middleware('auth:cliente')->name('website.perfil');

    Route::get('/agendamento', function () {
        return view('website.agendamento');
    })->middleware('auth:cliente')->name('website.agendamento');

    Route::get('/servicos', function () {
        return view('website.servicos');
    })->middleware('auth:cliente')->name('website.servicos');

    Route::get('/produtos', function () {
        return view('website.produtos');
    })->middleware('auth:cliente')->name('website.produtos');

    Route::get('/cadastro2', function () {
        return view('website.cadastro2');
    })->middleware('auth:cliente')->name('website.cadastro2');

    Route::post('/cadastroCompletar', [CadastrarClienteController::class, 'guardar_cadastro_completo'])->name('cadastro.cadastroCompletar');
});

// Rota de logout
Route::get('website/logout', [LoginClienteController::class, 'deslogar'])->name('logout');




