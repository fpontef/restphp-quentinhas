<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Necessário para ler a Classe Entregador:
use App\Entregadores;

class EntregadorController extends Controller
{
    public function index(){
        $entregador = Entregadores::all();
        return response()->json($entregador);
    }
    // Original, sem consultas opcionais:
    // public function show($id){
    //     $entregador = Entregadores::find($id);
    //     if (!$entregador){
    //         return response()->json(['message'=> 'Registro nao encontrado.', 404]);
    //     }
    //     return response()->json($entregador);
    // }      
    
    // Modelo CONSULTA API RELACIONAL
    // Dados do Entregador + Empresa: 
    // http://restphp-sobralense.c9users.io/public/api/entregador/2?includes=empresa
    public function show($id, Request $request){
        $entregador = Entregadores::find($id);
        $includes = $request->get('includes', null);
        if ($includes){
            $includes = explode(',', $includes);
            $entregador -> load($includes);
        }
        return response()->json($entregador);
        // Pode usar também retorno direto, pois já é JSON:
        // return $entregador;
    }
    
    // Busca Empresa associada ao Entregador
    public function empresa($id){
        $entregador = Entregadores::find($id)->empresa;
        if (!$entregador){
            return response()->json(['message'=> 'Registro nao encontrado.', 404]);
        }
        return response()->json($entregador);
    }
    public function store(Request $request){
        $entregador = new Entregadores();
        $entregador->fill($request->all());
        $entregador->save();
        // HTTP STATUS CODE 201 - Created
        return response()->json($entregador, 201);
    }
    public function update(Request $request, $id){
        $entregador = Entregadores::find($id);
        if(!$entregador){
            return response()->json(['message'=>'Registro nao encontrado'], 404);
        }
        
        $entregador->fill($request->all());
        $entregador->save();
        return response()->json($entregador);
    }
    public function destroy($id){
        $entregador = Entregadores::find($id);
        if(!$entregador){
            return response()->json(['message'=>'Registro nao encontrado'], 404);
        }
        $entregador->delete();
    }
    
}
