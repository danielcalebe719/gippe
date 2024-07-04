<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GaleriaImagens; // Importe o modelo GaleriaImagem

class WebsiteIndexController extends Controller
{
    public function index()
    {
        $imagens = GaleriaImagens::all(); // Busca todas as imagens da tabela galeria_imagens

        return view('website.index', compact('imagens'));
    }
}
