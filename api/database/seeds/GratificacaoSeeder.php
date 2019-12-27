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


        $classes = [
            'CLASSE I' => ['GOVERNADOR'],
            'CLASSE II' => ['DIRETORES'],
            'CLASSE III' => ['FGE', 'FGA-I', 'FGP-I'],
            'CLASSE IV' => ['FGA-II', 'FGP-II', 'FGA-III', 'FGO-I', 'EMPREGADOS DE NIVEL SUPERIOR'],
            'CLASSE V' => ['FGS-I', 'FGO-II', 'FGS-II', 'FGS-III'],
            'CLASSE VI' => ['DEMAIS EMPREGADOS'],
        ];

      foreach ($gratificacoes as $gratificacao) {

        $gratificacaoExiste = \Diarias\Gratificacao\Models\GratificacaoModel::where('grat_nome', '=', $gratificacao->descricao_gratificacao)->first();

        if ($gratificacaoExiste)
        {
            continue;
        }

        $descricaoClasse = '';

        foreach ($classes as $key => $value) {
            if (in_array($gratificacao->descricao_gratificacao, $value)) {
                $descricaoClasse = $key;
                break;
            }
        }

        $classe = \Diarias\Classe\Models\ClasseModel::where('clas_nome', '=', $descricaoClasse)->first();

        $novaGratificacao = new \Diarias\Gratificacao\Models\GratificacaoModel();

        $novaGratificacao->grat_nome = $gratificacao->descricao_gratificacao;
        $novaGratificacao->grat_slug = \Illuminate\Support\Str::slug($gratificacao->descricao_gratificacao);
        $novaGratificacao->grat_valor_diaria = $gratificacao->valor;
        $novaGratificacao->id_classe = $classe->clas_id;
        $novaGratificacao->created_by = 1;

        $novaGratificacao->save();
      }
    }
}
