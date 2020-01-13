<?php

use Illuminate\Database\Seeder;
use Diarias\Organograma\Models\OrganogramaModel;

class OrganogramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrganogramaModel::truncate();
        $organogramas = collect([
            [
                'orga_id' => 1,
                'orga_codigo' => '2018.1',
                'orga_data_inicio' => '2018-06-01',
                'orga_data_fim' => '2019-02-25',
                'created_by' => 1
            ],
            [
                'orga_id' => 2,
                'orga_codigo' => '2019.1',
                'orga_data_inicio' => '2019-02-26',
                'orga_data_fim' => null,
                'created_by' => 1
            ]
        ]);
        foreach ($organogramas as $organograma) {
            OrganogramaModel::create($organograma);
        }
    }
}
