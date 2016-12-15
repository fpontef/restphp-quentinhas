<?php

use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Cliente::create([
            'nome' => 'Ciclano Jose de Sousa',
            'telefone' => '88-9991-1293',
            'endereco' => 'Rua Acula, 1020 - Junco',
            'referencia' => 'Proximo a Dona Benedita',
            'data_nascimento' => '1980/10/10',
        ]);
        App\Cliente::create([
            'nome' => 'Francisco de Almeida',
            'telefone' => '88-99121-2312',
            'endereco' => 'Av Jose Anchieta, 360 - Cidade dos Funcionarios',
            'referencia' => 'Em frente a Wender Variedades',
            'data_nascimento' => '1943/06/10',
        ]);
    }
}
