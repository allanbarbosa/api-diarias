<?php

use Illuminate\Database\Seeder;
use Diarias\GrupoInternacional\Models\GrupoInternacionalModel;

class GrupoInternacionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GrupoInternacionalModel::truncate();
        $gruposInternacionais = collect([
            [
                'grup_int_codigo' => 'A',
                'created_by' => 1
            ],
            [
                'grup_int_codigo' => 'B',
                'created_by' => 1
            ],
            [
                'grup_int_codigo' => 'C',
                'created_by' => 1
            ],
            [
                'grup_int_codigo' => 'D',
                'created_by' => 1
            ],
        ]);
        foreach ($gruposInternacionais as $grupoInternacional) {
            GrupoInternacionalModel::create($grupoInternacional);
        }
    }
}
