<?php

use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = \Illuminate\Support\Facades\DB::connection('diariasProducao')->table('classe')
            ->where('flag_seq', true)
            ->orderBy('id_classe', 'ASC')
            ->get();

        foreach ($classes as $classe) {

            $classeExiste = \Diarias\Classe\Models\ClasseModel::where('clas_nome', '=', $classe->nome_classe)->first();

            if ($classeExiste) {
                continue;
            }

            $novaClasse = new \Diarias\Classe\Models\ClasseModel();

            $novaClasse->clas_nome = $classe->nome_classe;
            $novaClasse->created_by = 1;

            $novaClasse->save();
      }
    }
}
