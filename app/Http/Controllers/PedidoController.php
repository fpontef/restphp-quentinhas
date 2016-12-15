<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;

//Necessário para ler a Classe Pedido:
use App\Pedido;

//Necessário para manter relação com Produto.. talvez não.
use App\Produto;

class PedidoController extends Controller
{
    // Index - Original.
    // public function index(){
    //     $pedido = Pedido::all();
    //     return response()->json($pedido);
    // }    

    // // Index - OK - c/ With pra puxar relações.
    public function index(){
        $pedido = Pedido::with(["produto", "cliente","soma"])->get();
        // return response()->json([
        //         '$id' => '$id'
        //     ]);
        return $pedido;
    }
    
    // Index - Testando
    // public function index(){
    //     $pedidos = Pedido::with(['produto', 'cliente'])->get();
        
    //     for($i = 0; $i < count($pedidos); $i++)
    //     {
    //         $pedidos[$i]['soma'] = 0;
    //         foreach ($pedidos[$i]['produto'] as $v):
    //             $pedidos[$i]['soma'] += ((float)$v['pivot']['valor'] * (int)$v['pivot']['quantidade']);
    //         endforeach;
    //     }
        
    //     // var_dump($pedidos->toArray());
    //     return $pedidos;
    // }
    
    
    // Original
    // public function show($id){
    //     $pedido = Pedido::find($id);
    //     if (!$pedido){
    //         return response()->json(['message'=> 'Registro nao encontrado.', 404]);
    //     }
    //     return response()->json($pedido);
    // }
    
    // Modelo CONSULTA API RELACIONAL
    //http://restphp-sobralense.c9users.io/public/api/pedido/1?includes=cliente
    public function show($id, Request $request){
        $pedido = Pedido::find($id);
        $includes = $request->get('includes', null);
        if ($includes){
            $includes = explode(',', $includes);
            $pedido -> load($includes);
        }
        return response()->json($pedido);
    }
    
    public function store(Request $request){
        $pedido = new Pedido();
        // Desativo por agora trabalhar com produto_id que pertence a outra Tabela.
        // $pedido->fill($request->all());
        $pedido->observacao = $request->observacao;
        $pedido->status = $request->status;
        $pedido->valor_entrega = $request->valor_entrega;
        // $pedido->valor_pedido = $request->valor_pedido;
        $pedido->cliente_id = $request->cliente_id;
        $pedido->entregadores_id = $request->entregadores_id;
        $pedido->save();
        
        //Teste de Fill na tabela Pedido_Produto
        // Original:
        $produtos = $request->produtos;
        // print_r($produtos);
        // dd($produtos);
        // $pedido->produto()->sync($request->produtos, false);
        
        $pedido->produto()->sync($request->produtos, false);

        // HTTP STATUS CODE 201 - Created
        return response()->json($pedido, 201);
    }
    public function update(Request $request, $id){
        $pedido = Pedido::find($id);
        if(!$pedido){
            return response()->json(['message'=>'Registro nao encontrado'], 404);
        }
        
        $pedido->fill($request->all());
        $pedido->save();
        
        return response()->json($pedido);
    }
    
    public function destroy($id){
        $pedido = Pedido::find($id);
        if(!$pedido){
            return response()->json(['message'=>'Registro nao encontrado'], 404);
        }
        $pedido->delete();
    }
    
}
