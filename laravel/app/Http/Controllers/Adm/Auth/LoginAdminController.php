<?php

namespace App\Http\Controllers\Adm\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

            return redirect()->intended('/adm/');
        }

        Session::flash('mensagem', 'Nome de usuário ou senha inválidos!');
        return redirect()->back()->withInput();
    }

    public function deslogar(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/adm/login');
    }
}
