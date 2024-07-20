<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adm\ClienteController;
use App\Http\Controllers\Adm\PedidoController;
use App\Http\Controllers\Adm\NotificacaoController;
use App\Http\Controllers\Adm\AgendamentoController;
use App\Http\Controllers\Adm\ProdutoController;
use App\Http\Controllers\Adm\MateriaPrimaController;
use App\Http\Controllers\Adm\ServicoController;
use App\Http\Controllers\Adm\FornecedorController;
use App\Http\Controllers\Adm\ReceitaItemController;
use App\Http\Controllers\Adm\GaleriaImagemController;
use App\Http\Controllers\Adm\GastoController;
use App\Http\Controllers\Adm\MensagemController;
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
use App\Http\Controllers\Adm\OperacionalController;
use App\Http\Middleware\RedirectIfNotAdmin;
Route::get('/pr', function () {
    return view('website.produtos');
})->name('website.produtos');


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

    Route::get('/mensagens', function () {
        return view('adm.mensagens');
    })->name('adm.mensagens');

    // Rotas específicas para clientes dentro do grupo 'adm/clientes'
    Route::prefix('clientes')->group(function () {
        Route::get('/', [ClienteController::class, 'index'])->name('clientes.index');
        Route::get('/show/{idClientes}', [ClienteController::class, 'show'])->name('clientes.show');
        Route::get('/showEnderecos/{idClientes}', [ClienteController::class, 'showEnderecos'])->name('clientes.showEnderecos');
        Route::get('/showEndereco/{idClientes}', [ClienteController::class, 'showEndereco'])->name('clientes.showEndereco');
        Route::post('/guardar', [ClienteController::class, 'guardar'])->name('clientes.guardar');
        Route::post('/guardarEndereco', [ClienteController::class, 'guardarEndereco'])->name('clientes.guardarEndereco');
        Route::get('/remover/{idClientes}', [ClienteController::class, 'remover'])->name('clientes.remover');
        Route::get('/removerEndereco/{idEnderecos}', [ClienteController::class, 'removerEndereco'])->name('clientes.removerEndereco');
    });

    // Rotas específicas para pedidos dentro do grupo 'adm/pedidos'
    Route::prefix('pedidos')->group(function () {
        Route::get('/', [PedidoController::class, 'index'])->name('pedidos.index');
        Route::get('/show/{idPedidos}', [PedidoController::class, 'show'])->name('pedidos.show');
        Route::post('/guardar', [PedidoController::class, 'guardar'])->name('pedidos.guardar');
        Route::get('/aceitar/{idPedidos}', [PedidoController::class, 'aceitar'])->name('pedidos.aceitar');
        Route::get('/remover/{idPedidos}', [PedidoController::class, 'remover'])->name('pedidos.remover');
        Route::get('/showFeedback/{idPedidos}', [PedidoController::class, 'showFeedback'])->name('pedidos.showFeedback');
    });
    // Rotas específicas para pedidos dentro do grupo 'adm/pedidos'
    Route::prefix('notificacoes')->group(function () {
        Route::get('/', [NotificacaoController::class, 'index'])->name('notificacoes.index');
        Route::get('/show/{idNotificacoes}', [NotificacaoController::class, 'show'])->name('notificacoes.show');
        Route::post('/guardarCliente', [NotificacaoController::class, 'guardarCliente'])->name('notificacoes.guardarCliente');
        Route::post('/guardarAdmin', [NotificacaoController::class, 'guardarAdmin'])->name('notificacoes.guardarAdmin');
        Route::get('/removerCliente/{idNotificacoes}', [NotificacaoController::class, 'removerCliente'])->name('notificacoes.removerCliente');
        Route::get('/removerColaborador/{idNotificacoes}', [NotificacaoController::class, 'removerColaborador'])->name('notificacoes.removerColaborador');
    });
    // Rotas específicas para pedidos dentro do grupo 'adm/pedidos'
    Route::prefix('agendamentos')->group(function () {
        Route::get('/', [AgendamentoController::class, 'index'])->name('agendamentos.index');
        Route::get('/show/{idAgendamentos}', [AgendamentoController::class, 'show'])->name('agendamentos.show');
        Route::post('/guardar', [AgendamentoController::class, 'guardar'])->name('agendamentos.guardar');
        Route::get('/remover/{idAgendamentos}', [AgendamentoController::class, 'remover'])->name('agendamentos.remover');
    });
    Route::prefix('produtos')->group(function () {
        Route::get('/', [ProdutoController::class, 'index'])->name('produtos.index');
        Route::get('/show/{idProdutos}', [ProdutoController::class, 'show'])->name('produtos.show');
        Route::post('/guardar', [ProdutoController::class, 'guardar'])->name('produtos.guardar');
        Route::get('/remover/{idProdutos}', [ProdutoController::class, 'remover'])->name('produtos.remover');
    });
    Route::prefix('MateriaPrimaEstoque')->group(function () {
        Route::get('/', [MateriaPrimaController::class, 'index'])->name('materiasPrimas.index');
        Route::get('/show/{idMateriasPrimas}', [MateriaPrimaController::class, 'show'])->name('materiasPrimas.show');
        Route::post('/guardar', [MateriaPrimaController::class, 'guardar'])->name('materiasPrimas.guardar');
        Route::get('/remover/{idMateriasPrimas}', [MateriaPrimaController::class, 'remover'])->name('materiasPrimas.remover');
    });
    Route::prefix('servicos')->group(function () {
        Route::get('/', [ServicoController::class, 'index'])->name('servicos.index');
        Route::get('/show/{idServicos}', [ServicoController::class, 'show'])->name('servicos.show');
        Route::post('/guardar', [ServicoController::class, 'guardar'])->name('servicos.guardar');
        Route::get('/remover/{idServicos}', [ServicoController::class, 'remover'])->name('servicos.remover');
    });
    Route::prefix('fornecedores')->group(function () {
        Route::get('/', [FornecedorController::class, 'index'])->name('fornecedores.index');
        Route::get('/show/{idFornecedores}', [FornecedorController::class, 'show'])->name('fornecedores.show');
        Route::post('/guardar', [FornecedorController::class, 'guardar'])->name('fornecedores.guardar');
        Route::get('/remover/{idFornecedores}', [FornecedorController::class, 'remover'])->name('fornecedores.remover');
    });
    Route::prefix('receitasItens')->group(function () {
        Route::get('/', [ReceitaItemController::class, 'index'])->name('receitasItens.index');
        Route::get('/show/{idReceitasItens}', [ReceitaItemController::class, 'show'])->name('receitasItens.show');
        Route::post('/guardar', [ReceitaItemController::class, 'guardar'])->name('receitasItens.guardar');
        Route::get('/remover/{idReceitasItens}', [ReceitaItemController::class, 'remover'])->name('receitasItens.remover');
    });
    
    Route::prefix('admins')->group(function () {
        Route::get('/', [AdminController::class, 'index1'])->name('admins.index1');
        Route::get('/show/{idAdmins}', [AdminController::class, 'show'])->name('admins.show');
        Route::post('/create', [CadastrarAdminController::class, 'cadastrar'])->name('admins.create');
        Route::post('/update', [AdminController ::class, 'update'])->name('admins.update');
        Route::get('/remover/{idAdmins}', [AdminController::class, 'remover'])->name('admins.remover');
    }); 
    
    Route::prefix('galeriaImagens')->group(function () {
        Route::get('/', [GaleriaImagemController::class, 'index'])->name('galeriaImagens.index');
        Route::get('/show/{idGaleriaImagens}', [GaleriaImagemController::class, 'show'])->name('galeriaImagens.show');
        Route::post('/guardar', [GaleriaImagemController::class, 'guardar'])->name('galeriaImagens.guardar');
        Route::get('/remover/{idGaleriaImagens}', [GaleriaImagemController::class, 'remover'])->name('galeriaImagens.remover');
    });

    Route::prefix('painel-financeiro')->group(function () {
        Route::get('/', [GastoController::class, 'index'])->name('gastos.index');
        Route::get('/show/{idGastos}', [GastoController::class, 'show'])->name('gastos.show');
        Route::post('/guardar', [GastoController::class, 'guardar'])->name('gastos.guardar');
        Route::get('/remover/{idGastos}', [GastoController::class, 'remover'])->name('gastos.remover');
    });
    Route::prefix('painel-operacional')->group(function () {
        Route::get('/', [OperacionalController::class, 'index'])->name('op.index');
       
    });
    

    Route::prefix('mensagens')->group(function () {
        Route::get('/', [MensagemController::class, 'index'])->name('mensagens.index');
        Route::get('/show/{idMensagens}', [MensagemController::class, 'show'])->name('mensagens.show');
        Route::post('/guardar', [MensagemController::class, 'guardar'])->name('mensagens.guardar');
        Route::get('/remover/{idMensagens}', [MensagemController::class, 'remover'])->name('mensagens.remover');
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
use App\Http\Controllers\Website\WebsiteServicoController;
use App\Http\Controllers\Website\WebsiteProdutoController;
use App\Http\Controllers\Website\WebsiteAgendamentoController;
use App\Http\Controllers\Website\WebsitePerfilController;
use App\Http\Controllers\Website\PedidosDetalhesController;

// Rotas acessíveis sem autenticação
Route::get('/', function () {

    Route::get('/', [WebsiteIndexController::class, 'index'])->name('index');
})->name('index');

Route::post('notificacoes/marcar-lida/{id}', [WebsiteIndexController::class, 'marcarLida'])->name('notificacoes.marcarLida');


Route::get('website/login', [LoginClienteController::class, 'index'])->name('login');
Route::post('website/login', [LoginClienteController::class, 'logar'])->name('login.logar');

Route::get('website/cadastro', [CadastrarClienteController::class, 'MostrarFormularioCadastro'])->name('cadastro');
Route::post('website/cadastro', [CadastrarClienteController::class, 'cadastrar'])->name('cadastro.cadastrar');

// Rotas do prefixo 'website'
Route::prefix('website')->group(function () {
    Route::get('/', [WebsiteIndexController::class, 'index'])->name('website.index');
    Route::post('/mensagem', [WebsiteIndexController::class, 'mensagem_guardar'])->name('website.mensagem');

    Route::get('/perfil', [WebsitePerfilController::class, 'index'])
    ->middleware('auth:cliente')
    ->name('website.perfil');
    Route::post('/perfil/salvar', [WebsitePerfilController::class, 'salvar_dados_pessoais'])
    ->middleware('auth:cliente')
    ->name('website.perfil.salvar');

    Route::post('/perfil/salvar-endereco', [WebsitePerfilController::class, 'salvar_endereco_cliente'])
    ->middleware('auth:cliente')
    ->name('website.perfil.salvar.endereco');
    
    Route::post('/perfil/salvar-imagem', [WebsitePerfilController::class, 'salvar_imagem_perfil'])
    ->middleware('auth:cliente')
    ->name('website.salvar.imagem.perfil');
    
    Route::get('/feedback/{codigo}', [PedidosDetalhesController::class, 'feedback'])
    ->middleware('auth:cliente')
    ->name('pedidosDetalhes.feedback');

    Route::post('feedback/salvar', [PedidosDetalhesController::class, 'feedback_salvar'])
    ->middleware('auth:cliente')
    ->name('feedback.salvar');

    Route::get('/pedidos/pedidosDetalhes/{codigo}', [PedidosDetalhesController::class, 'index'])
    ->middleware('auth:cliente')
    ->name('pedidosDetalhes.index');



    Route::post('/atualizar/endereco', [PedidosDetalhesController::class, 'atualizar_endereco'])->name('endereco.atualizar');
    Route::post('/atualizar/cliente', [PedidosDetalhesController::class, 'atualizar_cliente'])->name('cliente.atualizar');

   

    Route::get('/agendamento/{codigo}', [WebsiteAgendamentoController::class, 'index'])
    ->middleware('auth:cliente')
    ->name('website.agendamento');
    



    Route::post('/agendamento', [WebsiteAgendamentoController::class, 'salvar'])
    ->middleware('auth:cliente')
    ->name('website.agendamento.salvar');



    Route::get('/servicos', [WebsiteServicoController::class, 'index'])
        ->middleware('auth:cliente')
        ->name('website.servicos');

        Route::get('/servicos/{codigo?}', [WebsiteServicoController::class, 'index'])
        ->middleware('auth:cliente')
        ->name('editar.servico');

        
        Route::post('/servicos/processar-servico', [WebsiteServicoController::class, 'salvar_personalizado'])->name('processar.servico.personalizado');
        Route::post('/servicos/processar-servico/padrao', [WebsiteServicoController::class, 'salvar_padrao'])->name('processar.servico.padrao');
    
        


        Route::get('/produtos/{codigo}', [WebsiteProdutoController::class, 'index'])
        ->middleware('auth:cliente')
        ->name('website.produtos');
   

            Route::post('/adicionar-ao-pedido' , [WebsiteProdutoController::class, 'adicionarAoPedido'])
            ->middleware('auth:cliente')
            ->name('pedido.adicionar');

      

// Em routes/web.php

Route::get('/carregar-mais-produtos' , [WebsiteProdutoController::class, 'carregarMaisProdutos'])
->middleware('auth:cliente');


    Route::get('/cadastro2/', [CadastrarClienteController::class, 'carregar_dados'])->middleware('auth:cliente')->name('website.cadastro2');
    Route::post('/cadastroCompletar', [CadastrarClienteController::class, 'guardar_cadastro_completo'])->name('cadastro.cadastroCompletar');
});

// Rota de logout
Route::get('website/logout', [LoginClienteController::class, 'deslogar'])->name('logout');

Route::get('website/politica-de-cookies', function () {
    return view('website.cookies');
})->name('website.cookies');



