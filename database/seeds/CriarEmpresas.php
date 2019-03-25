<?php

use Illuminate\Database\Seeder;

class CriarEmpresas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Faz o cadastro no BD da categoria de Consumidor Final
        DB::table('empresas')->insert([  //1
            'nome_empresa' => 'Empresa 1',
            'cnpj' => '11.111.111/1111-11',
            'nome_cidade' => 'Joinville',
        ]);
        DB::table('empresas')->insert([  //1
            'nome_empresa' => 'Empresa 2',
            'cnpj' => '22.222.333/4444-11',
            'nome_cidade' => 'Joinville',
        ]);
        DB::table('empresas')->insert([  //1
            'nome_empresa' => 'Empresa 3',
            'cnpj' => '33.333.444/4444-11',
            'nome_cidade' => 'Joinville',
        ]);
        DB::table('empresas')->insert([  //1
            'nome_empresa' => 'Empresa 4',
            'cnpj' => '44.555.555/1111-11',
            'nome_cidade' => 'Joinville',
        ]);
        DB::table('empresas')->insert([  //1
            'nome_empresa' => 'Empresa 5',
            'cnpj' => '55.666.666/1111-11',
            'nome_cidade' => 'Joinville',
        ]);
    }
}
