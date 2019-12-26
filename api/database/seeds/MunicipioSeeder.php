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
          ->join('estado', 'municipio.estado_id_estado', '=', 'estado.id_estado')
          ->where('municipio.flag_seq', true)
          ->orderBy('id_municipio', 'ASC')
          ->get();

      foreach ($municipios as $municipio) {

        $municipioExiste = \Diarias\Municipio\Models\MunicipioModel::where('muni_nome', '=', $municipio->nome_municipio)->first();

        if ($municipioExiste)
        {
            continue;
        }

        $estado = \Diarias\Estado\Models\EstadoModel::where('esta_sigla', '=', $municipio->sigla)->first();

        $novoMunicipio = new \Diarias\Municipio\Models\MunicipioModel();

        $novoMunicipio->muni_nome = $municipio->nome_municipio;
        $novoMunicipio->muni_codigo_ibge = $municipio->codigo_ibge;
        $novoMunicipio->muni_slug = \Illuminate\Support\Str::slug($municipio->nome_municipio);
        $novoMunicipio->muni_porcentagem_diaria = $municipio->porcentagem_diaria;
        $novoMunicipio->id_estado = $estado->esta_id;
        $novoMunicipio->created_by = 1;

        $novoMunicipio->save();
      }
    }
}
