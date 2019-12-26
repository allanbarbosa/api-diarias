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
        $siglas = [
            'Acre' => 'AC',
            'Alagoas' => 'AL',
            'Amazonas' => 'AM',
            'Amapá' => 'AP',
            'Bahia' => 'BA',
            'Ceará' => 'CE',
            'Distrito Federal' => 'DF',
            'Espírito Santo' => 'ES',
            'Goiás' => 'GO',
            'Maranhão' => 'MA',
            'Paraná' => 'PA',
            'Paraíba' => 'PB',
            'Pernambuco' => 'PE',
            'Piauí' => 'PI',
            'Pará' => 'PR',
            'Rio de Janeiro' => 'RJ',
            'Rio Grande do Norte' => 'RN',
            'Rondônia' => 'RO',
            'Roraima' => 'RR',
            'Rio Grande do Sul' => 'RS',
            'Santa Catarina' => 'SC',
            'Sergipe' => 'SE',
            'São Paulo' => 'SP',
            'Tocantins' => 'TO',
            'Mato Grosso' => 'MT',
            'Mato Grosso do Sul' => 'MS',
            'Minas Gerais' => 'MG'
        ];

        foreach ($siglas as $key => $estado) {

            $estadoExiste = \Diarias\Estado\Models\EstadoModel::where('esta_nome', '=', $key)->first();

            if ($estadoExiste) {
                continue;
            }

            $novoEstado = new \Diarias\Estado\Models\EstadoModel();

            $novoEstado->esta_nome = $key;
            $novoEstado->esta_sigla = $estado;
            $novoEstado->created_by = 1;

            $novoEstado->save();
        }
    }
}
