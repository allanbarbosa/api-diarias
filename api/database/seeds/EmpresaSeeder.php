<?php

use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresas = \Illuminate\Support\Facades\DB::connection('diariasProducao')->table('empresa')
            ->where('flag_seq', true)
            ->orderBy('id_empresa', 'ASC')
            ->get();

        foreach ($empresas as $empresa) {

            $empresaExiste = \Diarias\Empresa\Models\EmpresaModel::where('empr_sigla', '=', $empresa->sigla)->first();

            if ($empresaExiste) {
                continue;
            }

            $novaEmpresa = new \Diarias\Empresa\Models\EmpresaModel();

            $novaEmpresa->empr_nome = $empresa->nome_empresa;
            $novaEmpresa->empr_sigla = $empresa->sigla;
            $novaEmpresa->created_by = 1;

            $novaEmpresa->save();
        }
    }
}
