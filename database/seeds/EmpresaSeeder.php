<?php

use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Empresa::create([
            'nome' => 'EntregaMix',
            'telefone' => '88 - 3611 1111',
            'endereco' => 'Av Don Jose, 310 - Centro, Sobral',
            'cnpj' => '123.12312.213123-10',
            'email' => str_random(10).'@gmail.com',
        ]);
    }
}
