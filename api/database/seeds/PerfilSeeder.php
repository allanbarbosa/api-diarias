<?php

use Illuminate\Database\Seeder;
use Diarias\Perfil\Models\PerfilModel;
use Illuminate\Support\Str;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            'Funcionário',
        ];

        foreach ($dados as $key => $value) {
            
            $perfilExiste = PerfilModel::where('perf_descricao', '=', $value)->first();

            if ($perfilExiste) {
                continue;
            }

            $perfil = new PerfilModel();

            $perfil->perf_descricao = $value;
            $perfil->perf_slug = Str::slug($value);

            $perfil->save();
        }
    }
}
