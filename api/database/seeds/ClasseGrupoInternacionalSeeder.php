<?php

use Illuminate\Database\Seeder;
use Diarias\ClasseGrupoInternacional\Models\ClasseGrupoInternacionalModel;

class ClasseGrupoInternacionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClasseGrupoInternacionalModel::truncate();
        $classeGruposInternacionais = collect([
            [
                'id_grupo_internacional' => 1,
                'clas_gru_internacional_valor' => 200,
                'id_classe' => 2,
                'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 1,
              'clas_gru_internacional_valor' => 190,
              'id_classe' => 3,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 1,
              'clas_gru_internacional_valor' => 180,
              'id_classe' => 4,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 1,
              'clas_gru_internacional_valor' => 170,
              'id_classe' => 5,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 1,
              'clas_gru_internacional_valor' => 170,
              'id_classe' => 6 ,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 2,
              'clas_gru_internacional_valor' => 280,
              'id_classe' => 2 ,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 2,
              'clas_gru_internacional_valor' => 270,
              'id_classe' => 3 ,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 2,
              'clas_gru_internacional_valor' => 260,
              'id_classe' => 4 ,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 2,
              'clas_gru_internacional_valor' => 250,
              'id_classe' => 5 ,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 2,
              'clas_gru_internacional_valor' => 250,
              'id_classe' => 6,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 3,
              'clas_gru_internacional_valor' => 330,
              'id_classe' => 2,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 3,
              'clas_gru_internacional_valor' => 320,
              'id_classe' => 3,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 3,
              'clas_gru_internacional_valor' => 310,
              'id_classe' => 4,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 3,
              'clas_gru_internacional_valor' => 300,
              'id_classe' => 5,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 3,
              'clas_gru_internacional_valor' => 300,
              'id_classe' => 6,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 4,
              'clas_gru_internacional_valor' => 420,
              'id_classe' => 2,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 4,
              'clas_gru_internacional_valor' => 390,
              'id_classe' => 3,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 4,
              'clas_gru_internacional_valor' => 370,
              'id_classe' => 4,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 4,
              'clas_gru_internacional_valor' => 350,
              'id_classe' => 5,
              'created_by' => 1
            ],
            [
              'id_grupo_internacional' => 4,
              'clas_gru_internacional_valor' => 350,
              'id_classe' => 6,
              'created_by' => 1
            ]
        ]);
        foreach ($classeGruposInternacionais as $classeGrupoInternacional) {
            ClasseGrupoInternacionalModel::create($classeGrupoInternacional);
        }
    }
}
