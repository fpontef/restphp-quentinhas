<?php

use Illuminate\Database\Seeder;

class EntregadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Entregadores::create([
            'nome' => 'Fulano de Tal dos Anzois Pereira',
            'telefone' => '88-9911929123',
            'rg' => '200131232310',
            'cpf' => '123.123.123-10',
            'empresa_id' => 1,
        ]);
    }
}
