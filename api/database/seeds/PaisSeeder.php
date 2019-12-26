<?php

use Illuminate\Database\Seeder;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $paises = \Illuminate\Support\Facades\DB::connection('diariasProducao')->table('pais')
      ->where('flag_seq', true)
      ->orderBy('id_pais', 'ASC')
      ->get();

      foreach ($paises as $pais) {

        $nomePais = ucfirst(strtolower($pais->nome_pais));
        $paisExiste = \Diarias\Pais\Models\PaisModel::where('pais_nome', '=', $nomePais)->first();

        if ($paisExiste)
        {
            continue;
        }

        $novoPais = new \Diarias\Pais\Models\PaisModel();

        $novoPais->pais_nome = $nomePais;
        $novoPais->created_by = 1;

        $novoPais->save();
    }
      
    }
}
