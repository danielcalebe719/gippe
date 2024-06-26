<?php

use Illuminate\Support\Facades\Route;

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


