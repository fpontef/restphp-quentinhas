<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * 5) Pedido:
     * - Nome Cliente: [Cliente]
     * - Nome Produto: [Produto]
     * - Quantidade
     * - Total ou Somar Total?
     * - Status: 1 - Pendente, 2 - Em trânsito, 3 - Cancelado, 4 - Entregue.
     * protected $fillable = ['cliente_id', 'produto_id', 'entregador_id', 'quantidade', 
     * 'observacao', 'status', 'valor_entrega'];
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('quantidade');
            $table->string('observacao', 100);
            $table->integer('status');
            $table->float('valor_entrega');
            
            //cliente_id
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')
                  ->references('id')
                  ->on('clientes');

            // //relação One to One - ANTIGO agora removo pra ver o default
            // //produto_id
            // $table->integer('produto_id')->unsigned();
            // $table->foreign('produto_id')
            //       ->references('id')
            //       ->on('produtos');

            //entregador_id - Pode ser nulo.
            $table->integer('entregadores_id')->unsigned()->nullable();
            $table->foreign('entregadores_id')
                  ->references('id')
                  ->on('entregadores');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pedidos');
    }
}
