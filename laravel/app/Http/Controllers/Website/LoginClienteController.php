<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Clientes;        

class LoginClienteController extends Controller
{
    public function index()
    {
        

        
        return view('website.login');
    }
    public function logar(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::guard('cliente')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $cliente = Auth::guard('cliente')->user();
            $cliente->last_login = now();
            $cliente->save();
    
            return response()->json(['success' => true, 'redirect' => '/website']);
        }
    
        return response()->json(['success' => false, 'message' => 'Nome de usuário ou senha inválidos!']);
    }
    
    

    public function deslogar(Request $request)
    {
        Auth::guard('cliente')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/website/login');
    }
}
