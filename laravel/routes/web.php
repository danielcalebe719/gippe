<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
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

Route::get('/', function () {
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
});




Route::get('adm/', function () {
    return view('adm.templates.template');
});



Route::get('adm/agendamentos', function () {
    return view('adm.agendamentos');    
});
Route::get('adm/fornecedores', function () {
    return view('adm.fornecedores');    
});
Route::get('adm/galeriaImagens', function () {
    return view('adm.galeriaImagens');    
});
Route::get('adm/index', function () {
    return view('adm.index');    
});
Route::get('adm/MateriaPrimaEstoque', function () {
    return view('adm.MateriaPrimaEstoque');    
});
Route::get('adm/mensagens', function () {
    return view('adm.mensagens');    
});
Route::get('adm/notificacoes', function () {
    return view('adm.notificacoes');    
});
Route::get('adm/painel-financeiro', function () {
    return view('adm.painel-financeiro');    
});
Route::get('adm/painel-operacional', function () {
    return view('adm.painel-operacional');    
});
Route::get('adm/pedidos', function () {
    return view('adm.pedidos');    
});
Route::get('adm/produtos', function () {
    return view('adm.produtos');    
});
Route::get('adm/receitasItens', function () {
    return view('adm.receitasItens');    
});
Route::get('adm/servicos', function () {
    return view('adm.servicos');    
});


Route::get('/adm/financeiro', function () {
    return view('adm.painel-financeiro'); // Esta view pode conter um iframe ou um redirecionamento para a porta onde o servidor Node.js está rodando
});



//exemplo cargos
Route::prefix('/cargos')->group(function () {
    Route::get('/', 'App\Http\Controllers\Administrativo\CargosController@index');
    Route::get('/cadastro', 'App\Http\Controllers\Administrativo\CargosController@cadastro');
    Route::get('/cadastro/{id}', 'App\Http\Controllers\Administrativo\CargosController@cadastro');
    Route::get('/remover/{id}', 'App\Http\Controllers\Administrativo\CargosController@remover');
    Route::post('/salvar', 'App\Http\Controllers\Administrativo\CargosController@salvar');
});

//aplique aqui
// Rotas para clientes
Route::prefix('adm/clientes')->group(function () {
    Route::get('/', [ClienteController::class, 'index']);
    Route::get('/{idClientes}', [ClienteController::class, 'show']);
    Route::get('/{idClientes}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::post('/store', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/show/{idClientes}', [ClienteController::class, 'show']);
});




    





