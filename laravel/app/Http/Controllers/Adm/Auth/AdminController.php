<?php 
namespace App\Http\Controllers\Adm\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    public function index()
    {
        return view('adm.painel-operacional');
    }

    public function index1()
    {
        $admins = Admins::all();
        return view('adm.admins', compact('admins'));
    }

    public function show($idAdmins)
    {
        $admin = Admins::find($idAdmins);
       
        if ($admin) {

            
            return response()->json($admin);
        } else {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        }
    }

    public function update(Request $request) {
        // Valide os dados do request conforme necessário
        $admin = Admins::findOrFail($request->id);
        $admin->nome = $request->nome;
        $admin->email = $request->email;
        $admin->permissoes = $request->permissoes;
        
        if ($request->has('senha') && !empty($request->senha)) {
            $admin->password = Hash::make($request->senha); // Caso deseje atualizar a senha
        }
        
        $admin->save();
    
        return redirect()->back()->with('success', 'Colaborador atualizado com sucesso!');
    }

    public function remover($id)
    {
        $admin = Admins::find($id);
        if (!$admin) {
            return response()->json(['error' => 'Colaborador não encontrado.'], 404);
        }

        // Excluir o colaborador
        $admin->delete();

        return response()->json(['message' => 'Colaborador excluído com sucesso.'], 200);
    }
}