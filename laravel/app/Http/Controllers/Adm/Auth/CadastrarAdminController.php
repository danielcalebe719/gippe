<?php

namespace App\Http\Controllers\Adm\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CadastrarAdminController extends Controller
{
   /* public function MostrarFormularioCadastro()
    {
        return view('website.cadastro');
    }*/

    public function cadastrar(Request $request)
    {
        // Valida os dados do request
        $this->validator($request->all())->validate();
    
        // Cria o novo admin e armazena o resultado
        $admin = $this->create($request->all());
    
        // Redireciona para a página de admins com uma mensagem de sucesso
        return redirect('/adm/admins')->with('success', 'Admin registrado com sucesso!');
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
          
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

        protected function create(array $data)
        {
            
            return Admins::create([
                'nome' => $data['nome'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'permissoes' => $data['permissoes'],
            ]);
        }
        
    
}
