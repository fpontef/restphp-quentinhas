<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['cliente_id', 'produtos', 'valor', 'entregadores_id', 
                            'quantidade', 'observacao', 'status', 'valor_entrega'];
    
    function cliente(){
        return $this->belongsTo('App\Cliente');
    }

    // Vários para Vários, explicitando a relação Pedido/Produtos.
    function produto(){
        return $this->belongsToMany('App\Produto', 'pedido_produto')
                    ->withPivot('quantidade', 'valor');
    }
        
    function entregadores(){
        return $this->belongsTo('App\Entregadores');
    }
    
    //Soma dos produtos usando tabela PedidoProduto, que faz a relação.
    public function soma()
    {
        return $this->belongsTo(PedidoProduto::class, 'id','pedido_id')
            ->selectRaw('pedido_id,sum(valor*quantidade) as total_pedido')
            ->groupBy('pedido_id');
    }
}
