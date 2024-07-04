<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CadastrarClienteController extends Controller
{
    public function MostrarFormularioCadastro()
    {
        return view('website.cadastro');
    }

    public function cadastrar(Request $request)
    {
        $this->validator($request->all())->validate();

        $cliente = $this->create($request->all());

        return redirect('/website/login')->with('success', 'Cliente registrado com sucesso!');
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
        return Clientes::create([
           
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
