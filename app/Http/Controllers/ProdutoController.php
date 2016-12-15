<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Necessário para ler a Classe Produto:
use App\Produto;

class ProdutoController extends Controller
{
    public function index(){
        $produto = Produto::all();
        return response()->json($produto);
    }
    
    //Modelo inicial da consulta ao ID:
    // public function show($id){
    //     $produto = Produto::find($id);
    //     if (!$produto){
    //         return response()->json(['message'=> 'Registro nao encontrado.', 404]);
    //     }
    //     return response()->json($produto);
    // }
    
    // Modelo CONSULTA API RELACIONAL
    //http://restphp-sobralense.c9users.io/public/api/pedido/1?includes=cliente
    public function show($id, Request $request){
        $produto = Produto::find($id);
        $includes = $request->get('includes', null);
        if ($includes){
            $includes = explode(',', $includes);
            $produto -> load($includes);
        }
        return response()->json($produto);
    }
    
    public function store(Request $request){
        $produto = new Produto();
        $produto->fill($request->all());
        $produto->save();
        // HTTP STATUS CODE 201 - Created
        return response()->json($produto, 201);
    }
    public function update(Request $request, $id){
        $produto = Produto::find($id);
        if(!$produto){
            return response()->json(['message'=>'Registro nao encontrado'], 404);
        }
        
        $produto->fill($request->all());
        $produto->save();
        
        return response()->json($produto);
    }
    
    public function destroy($id){
        $produto = Produto::find($id);
        if(!$produto){
            return response()->json(['message'=>'Registro nao encontrado'], 404);
        }
        $produto->delete();
    }
    
}
