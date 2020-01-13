<?php

use Illuminate\Database\Seeder;
use Diarias\Unidade\Models\UnidadeModel;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnidadeModel::truncate();
        $unidades = collect([
            [
                'unid_sigla' => 'DIPRE',
                'unid_nome' => 'Diretoria da Presidência',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'DIRAF',
                'unid_nome' => 'Diretoria Administrativa e Financeira',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'DIHAB',
                'unid_nome' => 'Diretoria de Habitação',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'APO',
                'unid_nome' => 'Acessoria de Planejamento Orçamentário',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'GEFIN',
                'unid_nome' => 'Gerência Financeira',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'GEPES',
                'unid_nome' => 'Setor de Pessoal',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'NTI',
                'unid_nome' => 'Núcleo de Tecnologia da Informação',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'SEDEN',
                'unid_nome' => 'Setor de Desenvolvimento',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'COSOC',
                'unid_nome' => 'Coordenação de Atuação Social',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'UNSOC I',
                'unid_nome' => 'Unidade de Atuação Social I',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'UNSOC II',
                'unid_nome' => 'Unidade de Atuação Social II',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'UNSOC III',
                'unid_nome' => 'Unidade de Atuação Social III',
                'created_by' => 1
            ],
            [
                'unid_sigla' => 'INOVA',
                'unid_nome' => 'Unidade de Inovação e Desenvolvimento',
                'created_by' => 1
            ]
        ]);
        foreach ($unidades as $unidade) {
            UnidadeModel::create($unidade);
        }
    }
}
