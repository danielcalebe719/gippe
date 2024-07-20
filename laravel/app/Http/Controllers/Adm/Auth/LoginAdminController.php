<?php

namespace App\Http\Controllers\Adm\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Admins;

class LoginAdminController extends Controller
{
    public function index()
    {
        return view('adm.login');
    }
    public function logar(Request $request)
    {
        // Validação dos dados do formulário
          
        $messages = [
            'email.required' => 'O campo email é obrigatório.',
            'email.email'    => 'O formato do email é inválido.',
            'password.required' => 'O campo senha é obrigatório.',
        ];
    
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);
        
        // Tenta autenticar o usuário
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $admin = Auth::guard('admin')->user();
            $admin->last_login = now();
            $admin->save();
    
            // Redireciona com base nas permissões do administrador
            $admins = Admins::where('id', $admin->id)->first();
            switch($admins->permissoes) {
                case 1:
                case 2:
                    return redirect()->intended('/adm/painel-operacional');
                case 3:
                    return redirect('/adm/painel-financeiro');
                default:
                    return redirect('/adm/login/')->with('mensagem', 'Permissão não reconhecida.');
            }
        }
    
        // Se a autenticação falhar, define a mensagem de flash e redireciona
        Session::flash('mensagem', 'Nome de usuário ou senha inválidos!');
        return redirect()->intended('/adm/login/');
    }

    public function deslogar(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/adm/login');
    }
}
