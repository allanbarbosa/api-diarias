<?php

use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $cargos = \Illuminate\Support\Facades\DB::connection('diariasProducao')->table('cargo')
          ->join('gratificacao', 'cargo.gratificacao_id_gratificacao', '=', 'gratificacao.id_gratificacao')
          ->where('cargo.flag_seq', true)
          ->orderBy('id_cargo', 'ASC')
          ->get();

      foreach ($cargos as $cargo) {

        $cargoExiste = \Diarias\Cargo\Models\CargoModel::where('carg_nome', '=', $cargo->descricao_cargo)->first();

        if ($cargoExiste)
        {
            continue;
        }

        $gratificacao = \Diarias\Gratificacao\Models\GratificacaoModel::where('grat_nome', '=', $cargo->descricao_gratificacao)->first();

        $novoCargo = new \Diarias\Cargo\Models\CargoModel();

        $novoCargo->carg_nome = $cargo->descricao_cargo;
        $novoCargo->carg_slug = \Illuminate\Support\Str::slug($cargo->descricao_cargo);
        $novoCargo->id_gratificacao = $gratificacao->grat_id;
        $novoCargo->created_by = 1;

        $novoCargo->save();
      }
    }
}
