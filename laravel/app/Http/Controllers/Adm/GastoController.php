<?php
namespace App\Http\Controllers\Adm;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Gastos;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class GastoController extends Controller
{
    public function index()
    {
        $gastos = Gastos::all();
        $gastosPendentes = Gastos::where("status",'1')->get();
        return view('adm.painel-financeiro', compact('gastos', 'gastosPendentes'));
    }

    public function show($idGastos)
    {
        $gasto = Gastos::find($idGastos);
        
        if ($gasto) {

            
            return response()->json($gasto);
        } else {
            return response()->json(['error' => 'gasto não encontrado'], 404);
        }
    }
    
    
    public function guardar(Request $request)
    {
         
    
        try {
            // Busca ou cria um novo fornecedor
            $gasto = $request->idGasto ? Gastos::findOrFail($request->idGasto) : new Gastos();
    
            // Preenche os outros campos do gasto
            $gasto->motivo = $request->input('motivo');
            $gasto->valor = $request->input('valor');
            $gasto->departamento = $request->input('departamento');
            $gasto->status = $request->input('status');
            if(!$request->idGasto){
                $gasto->dataCadastro = now();
            }
            
            
    
            
    
            // Atualiza o timestamp de atualização
            $gasto->dataAtualizacao = now();  
    
            // Salva o cliente
            $gasto->save();
            
            return redirect()->back()->with('success', 'Fornecedor adicionado/atualizado com sucesso!');
            
        } catch (\Exception $e) {
            // Loga o erro para fins de debug
            Log::error('Erro ao atualizar o fornecedor: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar o fornecedor: ' . $e->getMessage()], 500);
        }
    }
    
    
    











    
    public function remover($idGasto)
    {
        try {

            // $materiasPrimasEstoque = MateriasPrimasEstoque::where('idFornecedor',$idFornecedor)->delete();
            $gasto = Gastos::findOrFail($idGasto);
           
            
        


            $gasto->delete();

            return response()->json(['message' => 'Fornecedor excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o fornecedor: ' . $e->getMessage()], 500);
        }       
    }
}
