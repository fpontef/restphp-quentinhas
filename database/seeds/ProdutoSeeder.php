<?php

use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Produto::create([
            'nome' => 'Marmita 1',
            'descricao' => 'Arroz, feijão, bife e salada de tomate.',
            'custo' => '15',
        ]);        
        App\Produto::create([
            'nome' => 'Marmita 2',
            'descricao' => 'Arroz, feijão, bife e ovo frito.',
            'custo' => '18',
        ]);
        App\Produto::create([
            'nome' => 'Marmita 3',
            'descricao' => 'Arroz, feijão, file de frango, creme de milho.',
            'custo' => '14',
        ]);        
        App\Produto::create([
            'nome' => 'Marmita 4',
            'descricao' => 'Arroz, feijão, file de frango e salada de tomate.',
            'custo' => '10',
        ]);
    }
}
