<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //unsigned() significa que não vai usar negativos. Isso aumenta o "range" ex: -1000 para 1000
        // então ele usaria + ou - 2003 dígitos e pesa no banco.
        Schema::create('pedido_produto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantidade');
            $table->float('valor');
            $table->integer('pedido_id')->unsigned();
            $table->foreign('pedido_id')
                  ->references('id')
                  ->on('pedidos');
            
            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')
                  ->references('id')
                  ->on('produtos');
            
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pedido_produto');
    }
}
