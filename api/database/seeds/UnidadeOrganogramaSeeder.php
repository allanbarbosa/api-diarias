<?php

use Illuminate\Database\Seeder;
use Diarias\UnidadeOrganograma\Models\UnidadeOrganogramaModel;

class UnidadeOrganogramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnidadeOrganogramaModel::truncate();
        $listaUnidadeOrganograma = collect([
            [
                'unid_org_id' => 1,
                'id_unidade' => 1,
                'id_unidade_pai' => null,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 3
            ],
            [
                'unid_org_id' => 2,
                'id_unidade' => 2,
                'id_unidade_pai' => null,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 4
            ],
            [
                'unid_org_id' => 3,
                'id_unidade' => 3,
                'id_unidade_pai' => null,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 3
            ],
            [
                'unid_org_id' => 4,
                'id_unidade' => 4,
                'id_unidade_pai' => 1,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 5
            ],
            [
                'unid_org_id' => 5,
                'id_unidade' => 5,
                'id_unidade_pai' => 2,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 6
            ],
            [
                'unid_org_id' => 6,
                'id_unidade' => 6,
                'id_unidade_pai' => 2,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 7,
                'id_unidade' => 7,
                'id_unidade_pai' => 2,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 8,
                'id_unidade' => 8,
                'id_unidade_pai' => 7,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 9,
                'id_unidade' => 9,
                'id_unidade_pai' => 3,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 10,
                'id_unidade' => 10,
                'id_unidade_pai' => 9,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 11,
                'id_unidade' => 11,
                'id_unidade_pai' => 9,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 12,
                'id_unidade' => 12,
                'id_unidade_pai' => 9,
                'id_organograma' => 1,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 13,
                'id_unidade' => 1,
                'id_unidade_pai' => null,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 3
            ],
            [
                'unid_org_id' => 14,
                'id_unidade' => 2,
                'id_unidade_pai' => null,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 4
            ],
            [
                'unid_org_id' => 15,
                'id_unidade' => 3,
                'id_unidade_pai' => null,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 3
            ],
            [
                'unid_org_id' => 16,
                'id_unidade' => 4,
                'id_unidade_pai' => 1,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 5
            ],
            [
                'unid_org_id' => 17,
                'id_unidade' => 5,
                'id_unidade_pai' => 2,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 6
            ],
            [
                'unid_org_id' => 18,
                'id_unidade' => 6,
                'id_unidade_pai' => 2,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 19,
                'id_unidade' => 7,
                'id_unidade_pai' => 2,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 20,
                'id_unidade' => 13,
                'id_unidade_pai' => 1,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 21,
                'id_unidade' => 9,
                'id_unidade_pai' => 3,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 22,
                'id_unidade' => 10,
                'id_unidade_pai' => 9,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 23,
                'id_unidade' => 11,
                'id_unidade_pai' => 9,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 1
            ],
            [
                'unid_org_id' => 24,
                'id_unidade' => 12,
                'id_unidade_pai' => 9,
                'id_organograma' => 2,
                'id_papel_fluxograma' => 1
            ]
        ]);
        foreach ($listaUnidadeOrganograma as $unidadeOrganograma) {
            UnidadeOrganogramaModel::create($unidadeOrganograma);
        }
    }
}
