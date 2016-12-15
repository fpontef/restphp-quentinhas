<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entregadores extends Model
{
    protected $fillable = ['nome','telefone', 'rg', 'cpf', 'empresa_id'];
    
    // Um entregador pertence a uma empresa: Belongs to.
    function empresa(){
        return $this->belongsTo('App\Empresa');
    }
    
    //Um entregador possui muitos pedidos
    function pedido(){
        return $this->hasMany('App\Pedido');
    }
}

// Remember, Eloquent will automatically determine the proper foreign key column on the Comment model.
// By convention, Eloquent will take the "snake case" name of the owning model and suffix it with _id.
// So, for this example, Eloquent will assume the foreign key on the Comment model is post_id.
//
// Dados do Entregador + Empresa: 
// http://restphp-sobralense.c9users.io/public/api/entregador/2?includes=empresa