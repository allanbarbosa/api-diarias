<?php

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = \Illuminate\Support\Facades\DB::connection('diariasProducao')->table('estado')
            ->where('flag_seq', true)
            ->orderBy('id_estado', 'ASC')
            ->get();

        $siglas = [
            'ACRE' => 'AC',
            'ALAGOAS' => 'AL',
            'AMAZONAS' => 'AM',
            'AMAPÁ' => 'AP',
            'BAHIA' => 'BA',
            'CEARÁ' => 'CE',
            'DISTRITO FEDERAL' => 'DF',
            'ESPÍRITO SANTO' => 'ES',
            'GOIÁS' => 'GO',
            'MARANHÃO' => 'MA',
            'PARANÁ' => 'PA',
            'PARAÍBA' => 'PB',
            'PERNAMBUCO' => 'PE',
            'PIAUÍ' => 'PI',
            'PARÁ' => 'PR',
            'RIO DE JANEIRO' => 'RJ',
            'RIO GRANDE DO NORTE' => 'RN',
            'RONDÔNIA' => 'RO',
            'RORAIMA' => 'RR',
            'RIO GRANDE DO SUL' => 'RS',
            'SANTA CATARINA' => 'SC',
            'SERGIPE' => 'SE',
            'SÃO PAULO' => 'SP',
            'TOCANTINS' => 'TO',
            'MATO GROSSO' => 'MT',
            'MATO GROSSO DO SUL' => 'MS',
            'MINAS GERAIS' => 'MG'
        ];

        foreach ($estados as $estado) {

            $nomeEstado = ucfirst(strtolower($estado->nome_estado));
            $estadoExiste = \Diarias\Estado\Models\EstadoModel::where('esta_nome', '=', $nomeEstado)->first();

            if ($estadoExiste)
            {
                continue;
            }

            $novoEstado = new \Diarias\Estado\Models\EstadoModel();

            $novoEstado->esta_nome = $nomeEstado;
            $novoEstado->esta_sigla = $siglas[$estado->nome_estado];
            $novoEstado->created_by = 1;

            $novoEstado->save();
        }
    }
}
