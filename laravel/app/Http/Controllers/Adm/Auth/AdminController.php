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
}