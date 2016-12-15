<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    // protected $fillable = ['cliente_id', 'produtos', 'valor', 'entregador_id', 'quantidade', 'observacao', 'status', 'valor_entrega'];
    protected $table = "pedido_produto";
    protected $fillable = ['pedido_id','produto_id','quantidade','valor'];
    public $timestamps = false;

}
