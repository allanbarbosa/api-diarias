<?php

use Illuminate\Database\Seeder;

class EscolaridadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $escolaridades = \Illuminate\Support\Facades\DB::connection('diariasProducao')->table('escolaridade')
            ->where('flag_seq', true)
            ->orderBy('id_escolaridade', 'ASC')
            ->get();

        foreach ($escolaridades as $escolaridade) {

            $escolaridadeExiste = \Diarias\Escolaridade\Models\EscolaridadeModel::where('esco_nome', '=', $escolaridade->descricao_escolaridade)
                ->first();

            if ($escolaridadeExiste) {
                continue;
            }

            $novaEscolaridade = new \Diarias\Escolaridade\Models\EscolaridadeModel();

            $novaEscolaridade->esco_nome = $escolaridade->descricao_escolaridade;
            $novaEscolaridade->esco_slug = \Illuminate\Support\Str::slug($escolaridade->descricao_escolaridade);
            $novaEscolaridade->created_by = 1;

            $novaEscolaridade->save();
        }
    }
}
