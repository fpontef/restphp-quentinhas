<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Necessário para ler a Classe Empresa:
use App\Empresa;

class EmpresaController extends Controller
{
    public function index(){
        $empresa = Empresa::all();
        return response()->json($empresa);
    }
    // public function show($id){
    //     $empresa = Empresa::find($id);
    //     if (!$empresa){
    //         return response()->json(['message'=> 'Registro nao encontrado.', 404]);
    //     }
    //     return response()->json($empresa);
    // }
    
    // Modelo CONSULTA API RELACIONAL
    //http://restphp-sobralense.c9users.io/public/api/empresa/1?includes=entregadores
    public function show($id, Request $request){
        $empresa = Empresa::find($id);
        $includes = $request->get('includes', null);
        if ($includes){
            $includes = explode(',', $includes);
            $empresa -> load($includes);
        }
        return response()->json($empresa);
    }    
    
    public function entregador($id){
        $empresa = Empresa::find($id)->entregadores;
        if (!$empresa){
            return response()->json(['message'=> 'Registro nao encontrado.', 404]);
        }
        return response()->json($empresa);
    }
    public function store(Request $request){
        $empresa = new Empresa();
        $empresa->fill($request->all());
        $empresa->save();
        // HTTP STATUS CODE 201 - Created
        return response()->json($empresa, 201);
    }
    public function update(Request $request, $id){
        $empresa = Empresa::find($id);
        if(!$empresa){
            return response()->json(['message'=>'Registro nao encontrado'], 404);
        }
        
        $empresa->fill($request->all());
        $empresa->save();
        
        return response()->json($empresa);
    }
    
    public function destroy($id){
        $empresa = Empresa::find($id);
        if(!$empresa){
            return response()->json(['message'=>'Registro nao encontrado'], 404);
        }
        $empresa->delete();
    }
    
}