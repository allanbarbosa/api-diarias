<?php

use Illuminate\Database\Seeder;

class GratificacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $gratificacoes = \Illuminate\Support\Facades\DB::connection('diariasProducao')->table('gratificacao')
      ->where('flag_seq', true)
      ->orderBy('id_gratificacao', 'ASC')
      ->get();

      foreach ($gratificacoes as $gratificacao) {

        $nomeGratificacao = ucfirst(strtolower($gratificacao->descricao_gratificacao));
        $gratificacaoExiste = \Diarias\Gratificacao\Models\GratificacaoModel::where('grat_nome', '=', $nomeGratificacao)->first();

        if ($gratificacaoExiste)
        {
            continue;
        }

        $novaGratificacao = new \Diarias\Gratificacao\Models\GratificacaoModel();

        $novaGratificacao->grat_nome = $nomeGratificacao;
        $novaGratificacao->grat_valor_diaria = $gratificacao->valor;
        $novaGratificacao->grat_slug = \Illuminate\Support\Str::slug($gratificacao->descricao_gratificacao);
        $novaGratificacao->created_by = 1;

        $novaGratificacao->save();
      }
    }
}
