<?php 
namespace App\Http\Controllers\Adm\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
}