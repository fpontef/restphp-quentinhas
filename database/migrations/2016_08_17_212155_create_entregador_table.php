<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregadorTable extends Migration
{
    /**
     * Run the migrations.
     * 2) Entregadores:
     * - Nome
     * - CPF
     * - RG
     * - Telefone
     * - Empresa: [empresa vinculada]
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('telefone', 60);
            $table->string('rg', 60);
            $table->string('cpf', 60);
            // $table->integer('empresa_id');

            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')
                  ->references('id')
                  ->on('empresas')
                  ->onDelete('cascade');
            
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
        Schema::drop('entregadores');
    }
}
