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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $admin = Auth::guard('admin')->user();
            $admin->last_login = now();
            $admin->save();
            $admins = Admins::where('id', $admin->id)->first();
            switch($admins->permissoes){
                case 1:
            return redirect()->intended('/adm/painel-operacional');
            case 2:
                return redirect()->intended('/adm/painel-operacional');
            case 3:
                return redirect()->intended('/adm/painel-financeiro');
            }   
        }
        
        Session::flash('mensagem', 'Nome de usuário ou senha inválidos!');

     
    }

    public function deslogar(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/adm/login');
    }
}
