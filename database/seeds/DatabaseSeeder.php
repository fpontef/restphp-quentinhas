<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $this->call(ClienteSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(EntregadorSeeder::class);
        $this->call(ProdutoSeeder::class);
        
        Model::reguard();
        
        // $this->call(UsersTableSeeder::class);
    }
}
