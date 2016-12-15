<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome','telefone', 'endereco', 'referencia', 'data_nascimento'];
    protected $date = ['data_nascimento'];
    
    function pedido(){
        return $this->hasMany('App\Pedido');
    }
    
}