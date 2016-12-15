<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome','descricao','custo'];

    // Relação Vários para Vários
    function pedido(){
        return $this->belongsToMany('App\Pedido', 'pedido_produto');
    }

}
