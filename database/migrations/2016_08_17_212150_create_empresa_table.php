<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * 3) Empresa Entregadores:
     * - Nome
     * - CNPJ
     * - Endereco
     * - Telefone
     * - Email
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('telefone', 60);
            $table->string('endereco', 100);
            $table->string('cnpj', 60);
            $table->string('email', 60);
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
        Schema::drop('empresas');
    }
}
