<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Necessário para ler a Classe Cliente usando o nome "Cliente":
use App\Cliente;

class ClienteController extends Controller
{
    // //ORIGINAL:
    // //GET-> $URL/api/cliente
    public function index(){
        $cliente = Cliente::all();
        return response()->json($cliente);
    }
    
    // Busca usando /api/busca + query.
    // Foge o padrão do REST
    public function busca(Request $request, Cliente $cliente){
        $testeVar = $cliente -> where('nome', 'like', '%'.$request->get('nome').'%') -> get();
        if (count($testeVar) == 0){
            return response()->json(['message'=> 'Registro nao encontrado.', 404]);
        }
        // Original:
        // return response()->json($cliente -> where('nome', 'like', '%'.$request->get('nome').'%') -> get());
        
        return response()->json($testeVar);
    }
    
    //GET-> $URL/api/cliente/1
    
    //Alternativa que recebe o Model como parâmetro:
    // public function show(Cliente $cliente){
    //     return $cliente;
    // }
    
    // Outra versão: Antes de juntar com consulta usando includes:
    // public function show($id){
    //     $cliente = Cliente::find($id);
    //     if (!$cliente){
    //         return response()->json(['message'=> 'Registro nao encontrado.', 404]);
    //     }
    //     return response()->json($cliente);
    // }
    
    // Modelo CONSULTA API RELACIONAL
    //URL: http://restphp-sobralense.c9users.io/public/api/cliente/1?includes=pedido
    public function show($id, Request $request){
        $cliente = Cliente::find($id);
        $includes = $request->get('includes', null);
        if ($includes){
            $includes = explode(',', $includes);
            $cliente -> load($includes);
        }
        return response()->json($cliente);
    }
    
    //POST-> $URL/api/cliente
    public function store(Request $request){
        $cliente = new Cliente();
        $cliente->fill($request->all());
        $cliente->save();
        // HTTP STATUS CODE 201 - Created
        return response()->json($cliente, 201);
    }
    
    //PUT(tudo) ou PATCH(atualiza trecho) -> $URL/api/cliente/1
    public function update(Request $request, $id){
        $cliente = Cliente::find($id);
        if(!$cliente){
            return response()->json(['message'=>'Registro nao encontrado'], 404);
        }
        
        $cliente->fill($request->all());
        $cliente->save();
        
        return response()->json($cliente);
    }
    
    //DELETE-> $URL/api/cliente/1
    public function destroy($id){
        $cliente = Cliente::find($id);
        if(!$cliente){
            return response()->json(['message'=>'Registro nao encontrado'], 404);
        }
        $cliente->delete();
    }
    
}