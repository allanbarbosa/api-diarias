<?php
declare(strict_types=1);

namespace Diarias\Dropdown;

use Diarias\Empresa\Models\EmpresaModel;

class EmpresaDropdown
{
    public function getDados()
    {
        $empresas = EmpresaModel::orderBy('empr_nome', 'ASC')->get();

        $dados = [];

        foreach ($empresas as $empresa)
        {
            $dados[] = [
                'value' => $empresa->empr_id,
                'label' => $empresa->empr_nome,
            ];
        }
        return $dados;
    }

}