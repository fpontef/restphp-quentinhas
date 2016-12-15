<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //Já faz automático o nome da tabela, sempre no plural:
    // protected $table = 'empresas';
    protected $fillable = ['nome','telefone', 'endereco', 'cnpj', 'email' ];
    
    //Uma empresa possui vários entregadores: "has Many"
    public function entregadores()
    {
        // Quando especifica o campo:
        // return $this->hasMany('App\Entregadores', 'empresa_id');
        // Quando o namespace App\ClasseTal.. etc é grande, pode-se fazer assim:
        //return $this->hasMany(Entregadores::class, 'empresa_id');
        // Documentação cita somente esse:
        return $this->hasMany('App\Entregadores');
    }
}
