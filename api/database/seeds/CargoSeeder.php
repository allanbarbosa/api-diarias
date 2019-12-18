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
      ->where('flag_seq', true)
      ->orderBy('id_cargo', 'ASC')
      ->get();

      foreach ($cargos as $cargo) {

        $nomeCargo = ucfirst(strtolower($cargo->descricao_cargo));
        $cargoExiste = \Diarias\Cargo\Models\CargoModel::where('carg_nome', '=', $nomeCargo)->first();

        if ($cargoExiste)
        {
            continue;
        }

        $novoCargo = new \Diarias\Cargo\Models\CargoModel();

        $novoCargo->carg_nome = $nomeCargo;
        $novoCargo->carg_slug = \Illuminate\Support\Str::slug($nomeCargo);
        $novoCargo->id_gratificacao = $cargo->gratificacao_id_gratificacao;
        $novoCargo->created_by = 1;

        $novoCargo->save();
      }
    }
}
