<?php

use Illuminate\Database\Seeder;
use Diarias\PapelFluxograma\Models\PapelFluxogramaModel;

class PapelFluxogramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PapelFluxogramaModel::truncate();
        $unidades = collect([
            [
                'pape_flu_id' => 1,
                'pape_flu_slug' => 'solicitante',
                'pape_flu_descricao' => 'Solicitante'
            ],
            [
                'pape_flu_id' => 2,
                'pape_flu_slug' => 'chefia',
                'pape_flu_descricao' => 'Chefia'
            ],
            [
                'pape_flu_id' => 3,
                'pape_flu_slug' => 'diretoria',
                'pape_flu_descricao' => 'Diretoria'
            ],
            [
                'pape_flu_id' => 4,
                'pape_flu_slug' => 'diretoria-administrativa-e-financeira',
                'pape_flu_descricao' => 'Diretoria Administrativa e Financeira'
            ],
            [
                'pape_flu_id' => 5,
                'pape_flu_slug' => 'planejamento-orcamentario',
                'pape_flu_descricao' => 'Planejamento Orçamentário'
            ],
            [
                'pape_flu_id' => 6,
                'pape_flu_slug' => 'financeiro',
                'pape_flu_descricao' => 'Financeiro'
            ]
        ]);
        foreach ($unidades as $unidade) {
            PapelFluxogramaModel::create($unidade);
        }
    }
}
