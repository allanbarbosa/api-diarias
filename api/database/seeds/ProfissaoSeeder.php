<?php

use Illuminate\Database\Seeder;

class ProfissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profissoes = \Illuminate\Support\Facades\DB::connection('diariasProducao')->table('profissao')
            ->where('flag_seq', true)
            ->orderBy('id_profissao', 'ASC')
            ->get();

        foreach ($profissoes as $profissao) {

            $profissaoExiste = \Diarias\Profissao\Models\ProfissaoModel::where('prof_nome', '=', $profissao->descricao_profissao)
                ->first();

            if ($profissaoExiste) {
                continue;
            }

            $novaProfissao = new \Diarias\Profissao\Models\ProfissaoModel();

            $novaProfissao->prof_nome = $profissao->descricao_profissao;
            $novaProfissao->prof_slug = \Illuminate\Support\Str::slug($profissao->descricao_profissao);
            $novaProfissao->created_by = 1;

            $novaProfissao->save();

        }
    }
}
