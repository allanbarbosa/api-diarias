<?php

use Illuminate\Database\Seeder;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $municipios = \Illuminate\Support\Facades\DB::connection('diariasProducao')->table('municipio')
      ->where('flag_seq', true)
      ->orderBy('id_municipio', 'ASC')
      ->get();

      foreach ($municipios as $municipio) {

        $nomeMunicipio = ucfirst(strtolower($municipio->nome_municipio));
        $municipioExiste = \Diarias\Municipio\Models\MunicipioModel::where('muni_nome', '=', $nomeMunicipio)->first();

        if ($municipioExiste)
        {
            continue;
        }

        $novoMunicipio = new \Diarias\Municipio\Models\MunicipioModel();

        $novoMunicipio->muni_nome = $nomeMunicipio;
        $novoMunicipio->muni_codigo_ibge = $municipio->codigo_ibge;
        $novoMunicipio->muni_porcentagem_diaria = $municipio->porcentagem_diaria;
        $novoMunicipio->id_estado = $municipio->estado_id_estado;
        $novoMunicipio->created_by = 1;

        $novoMunicipio->save();
      }
    }
}
